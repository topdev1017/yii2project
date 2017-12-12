<?php

namespace backend\controllers;

use backend\models\Images;
use backend\models\ImagesSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use Yii;
/**
 * ImagesController implements the CRUD actions for Images model.
 */
class ImagesController extends Controller
{
    public function beforeAction($action)
    {
        //if (!parent::beforeAction($action)) {
//            return false;
//        }
        Yii::$app->controller->enableCsrfValidation = false;
        // your custom code here

        return parent::beforeAction($action); // or false to not run the action
    }
    
    
	/**
	 * Lists all Images models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new ImagesSearch;
		$dataProvider = $searchModel->search($_GET);

        Url::remember();
		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single Images model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($ImgID)
	{
        Url::remember();
        return $this->render('view', [
			'model' => $this->findModel($ImgID),
		]);
	}

	/**
	 * Creates a new Images model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Images;
//        print_r($_POST); die();
		try {
            if ($model->load($_POST) && $model->save()) {
                return $this->redirect(Url::previous());
            } elseif (!\Yii::$app->request->isPost) {
                $model->load($_GET);
            }
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
            $model->addError('_exception', $msg);
		}
        return $this->render('create', ['model' => $model,]);
	}

	/**
	 * Updates an existing Images model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($ImgID)
	{
		$model = $this->findModel($ImgID);

		if ($model->load($_POST) && $model->save()) {
            return $this->redirect(Url::previous());
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Images model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($ImgID)
	{
		$this->findModel($ImgID)->delete();
		return $this->redirect(Url::previous());
	}

	/**
	 * Finds the Images model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Images the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($ImgID)
	{
		if (($model = Images::findOne($ImgID)) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
    public function actionUploadSliderImage() {
            $script_url =  Yii::getAlias('@script_url'); //'http://localhost/howtube/';
            $upload_dir =  Yii::getAlias('@root_name')."/resources/images/";// 'C:/xampp/htdocs/howtube/temp/images/';
            $upload_url =   Yii::getAlias('@script_url').'/resources/images/';

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
            return $result_json;
//            $json_array['filelink'] = $upload_url.$result->Products_image[0]->name;
            
//            echo stripslashes(json_encode($json_array));
//            Yii::$app->end();

    }
    
    public function actionUploadImage() {
            $script_url =  Yii::getAlias('@script_url'); //'http://localhost/howtube/';
            $upload_dir =  Yii::getAlias('@root_name')."/resources/images/";// 'C:/xampp/htdocs/howtube/temp/images/';
            $upload_url =   Yii::getAlias('@script_url').'/resources/images/';

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
            $json_array['filelink'] = $upload_url.$result->Products_image[0]->name;
            
            $images = new Images;
            $images->type = 'image';
            $images->file = $result->Products_image[0]->name;
            $images->caption = $result->Products_image[0]->name;
            $images->save();
            
            echo stripslashes(json_encode($json_array));
//            Yii::$app->end();

    }
    
    public function actionGetUploadWindow(){
        $dir = Yii::getAlias('@root_name')."/resources/images/";

        // Open a known directory, and proceed to read its contents
        //if (is_dir($dir)) {
//            if ($dh = opendir($dir)) {
//                $images = array();
//                while (($file = readdir($dh)) !== false) {
//                    if (!is_dir($dir.$file)) {
//                        $images[] = $file;
//                    }
//                }
//                closedir($dh);
//            }
//        }
        $images = Images::find()->where('type = "image"')->orderby('file ASC')->all();
        $image_model = new Images;
        
        $json = [];
        if($images){
            foreach($images as $img){
               $small_json['thumb'] =Yii::getAlias('@script_url').'/resources/images/thumbnail/'.$img->file;
               $small_json['image'] = Yii::getAlias('@script_url').'/resources/images/'.$img->file;
               $small_json['title'] = Yii::getAlias('@script_url').'/resources/images/'.$img->file;
               array_push($json, $small_json);
            }
        }
        return $this->renderPartial('_modal', [
                'image_model' => $image_model,
            ]);
        
    }
    
    
    
    public function actionGetAllImagesJson(){
        $dir = Yii::getAlias('@root_name')."/resources/images/";

        // Open a known directory, and proceed to read its contents
        //if (is_dir($dir)) {
//            if ($dh = opendir($dir)) {
//                $images = array();
//                while (($file = readdir($dh)) !== false) {
//                    if (!is_dir($dir.$file)) {
//                        $images[] = $file;
//                    }
//                }
//                closedir($dh);
//            }
//        }
        $images = Images::find()->where('type = "image"')->orderby('ImgID DESC')->all();
        
        
        $json = [];
        if($images){
            foreach($images as $img){
               $small_json['thumb'] =Yii::getAlias('@script_url').'/resources/images/thumbnail/'.$img->file;
               $small_json['image'] = Yii::getAlias('@script_url').'/resources/images/'.$img->file;
               $small_json['title'] = Yii::getAlias('@script_url').'/resources/images/'.$img->file;
               $small_json['IMGID'] = $img->ImgID;
               array_push($json, $small_json);
            }
        }
        
        echo json_encode($json);
    }
}
    