<?php

namespace backend\controllers;

use backend\models\ImportCsv;
use backend\models\Products;
use backend\models\Sizes;
use backend\models\Finishes;
use backend\models\Categories;
use backend\models\Specialized;
use backend\models\Manufactures;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\db\Query;


use Yii;

/**
 * FinishesController implements the CRUD actions for Finishes model.
 */
class ImportController extends Controller
{
    /**
     * Lists all Finishes models.
     * @return mixed
     */
    public function actionIndex()
    {
        Url::remember();
        $model = new ImportCsv();
        return $this->render('index', ['model'=>$model]);
    }
    
    public function actionUploadFile() {
            $script_url =  Yii::getAlias('@script_url'); //'http://localhost/howtube/';
            $upload_dir =  Yii::getAlias('@root_name')."/resources/import_files/";// 'C:/xampp/htdocs/howtube/temp/images/';
            $upload_url =   Yii::getAlias('@script_url').'/resources/import_files/';

            $options = array(
                'script_url' => $script_url,
                'upload_dir' => $upload_dir,
                'upload_url' => $upload_url,
                'param_name' => 'Products_image',
            );
            
            //print_r($options);
//            die();
            
            $upload_handler = new UploadHandler($options, true);
            $result_json = $upload_handler->do_upload();
            $result = json_decode($result_json);
            print_r($result_json);
            Yii::$app->end();
    }
    
    public function actionReadImportFile(){
        
        $importCsv = new ImportCsv();
        $importCsv->table = $_POST['ImportCsv']['table'];
        $importCsv->file = $_POST['ImportCsv']['file'];
        
        $column_names = $importCsv->getExcelSheetColumns();
        if($importCsv->table == 'Products'){
            $table_obj = new Products;
            return $this->renderAjax('_import_products', ['model'=>$importCsv, 'columns'=>$column_names, 'tmodel'=> $table_obj]);
        }elseif($importCsv->table == 'Sizes'){
            $table_obj = new Sizes;
            return $this->renderAjax('_import_sizes', ['model'=>$importCsv, 'columns'=>$column_names, 'tmodel'=> $table_obj]);
        }elseif($importCsv->table == 'Finishes'){
            $table_obj = new Finishes;
            return $this->renderAjax('_import_finishes', ['model'=>$importCsv, 'columns'=>$column_names, 'tmodel'=> $table_obj]);
        }elseif($importCsv->table == 'Categories'){
            $table_obj = new Categories;
            return $this->renderAjax('_import_categories', ['model'=>$importCsv, 'columns'=>$column_names, 'tmodel'=> $table_obj]);
        }elseif($importCsv->table == 'Specialized'){
            $table_obj = new Specialized;
            return $this->renderAjax('_import_specialized', ['model'=>$importCsv, 'columns'=>$column_names, 'tmodel'=> $table_obj]);
        }elseif($importCsv->table == 'Manufactures'){
            $table_obj = new Manufactures;
            return $this->renderAjax('_import_manufactures', ['model'=>$importCsv, 'columns'=>$column_names, 'tmodel'=> $table_obj]);
        }
    }
    
    public function actionDoImport(){
        $importCsv = new ImportCsv();
        $importCsv->table = $_POST['ImportCsv']['table'];
        $importCsv->file = $_POST['ImportCsv']['file'];
        $highestRow = $importCsv->do_import($importCsv->readExcelFile(), $_POST['columns']);
        return $this->renderAjax('_import_success', ['highestRow'=>$highestRow, 'model'=> $importCsv]);
    }
    
    public function actionSetAllShipLedProducts(){
//        $prObj = Products::findOne(471);
//        print_r($prObj->attributes);
//        die();
        foreach (Products::find()->each(100) as $product) {
            echo $product->PID."<br />";
//            $prObj = Products::findOne($pid);
//            print_r($product->attributes);echo "<br />";
            if(Products::isInLedCategory($product->PID)){
               $product->led = 1;
               $product->save(); 
            }
            
            if( Products::isInQuickShipCategory($product->PID)){
               $product->quick_ship = 1;
               $product->save(); 
            }        
        }    
    }

   
}

