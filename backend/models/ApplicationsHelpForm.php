<?php
namespace backend\models;

use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class ApplicationsHelpForm extends Model
{
    public $full_name;
    public $company;
    public $email;
    public $phone;
    public $comments;
    
    public $send_to = "no-reply@wfli.com";
    public $subject = "New application help";

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['full_name','company','email','phone','comments'], 'required'],
            [['full_name','company','email','phone','comments'], 'safe'],
            ['email','email']
        ];
    }
    
    public function sendEmail() {
        return Yii::$app->mailer->compose('ApplicationHelpForm',['model'=> $this])
            ->setTo($this->send_to)
            ->setFrom([$this->email => $this->full_name])
            ->setSubject($this->subject)
            ->send();
    }

}
