<?php
 
namespace console\controllers;

use Yii;
use yii\console\Controller;
use backend\models\User;
 
/**
 * Test controller
 */
class ReportController extends Controller {
 
    public function actionIndex() {
        $models = User::find()->all();
        if($models) {
            
            $filename = "report_".date("Y-m-d").".csv";
            $filePath = dirname(__FILE__)."/../../tmp/".$filename;
            
            $fp = fopen($filePath, 'w');
            
            $header = array(
                'User ID',
                'First Name',
                'Last Name',
                'Company',
                'Company Website',
                'Phone',
                'Email',
                'Register Date'
            );
            fputcsv($fp, $header);
            foreach($models as $model) {
                $output = array(
                    $model->id,
                    $model->first_name,
                    $model->last_name,
                    $model->company,
                    $model->company_website,
                    $model->phone,
                    $model->email,
                    $model->created_at
                );
                fputcsv($fp, $output);
            }
            fclose($fp);
            
            $sendTo = "timg@wfli.com";
            $sentFrom = 'luminaires@wfli.com';
            
            $email = Yii::$app->mailer->compose()
            ->setTo($sendTo)
            ->setFrom([$sentFrom => 'WFLI Reports'])
            ->setSubject("Montly User Report")
            ->setTextBody('Monthly User Report for '.date("Y-m-d"))
            ->attach($filePath)
            ->send();
            if($email) {
                unlink($filePath);
            }
        }
    }
 
    
}