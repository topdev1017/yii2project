<?php

namespace backend\controllers;

use Yii;
use backend\models\Manufactures;
use backend\models\ManufactureSpecialized;
use backend\models\ManufacturesSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * ManufacturesController implements the CRUD actions for Manufactures model.
 */
class ManufacturesController extends Controller
{
	/**
	 * Lists all Manufactures models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new ManufacturesSearch;
		$dataProvider = $searchModel->search($_GET);

        Url::remember();
		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single Manufactures model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($MID)
	{
        Url::remember();
        return $this->render('view', [
			'model' => $this->findModel($MID),
		]);
	}

	/**
	 * Creates a new Manufactures model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Manufactures;

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
	 * Updates an existing Manufactures model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($MID)
	{
		$model = $this->findModel($MID);
        if(Yii::$app->request->isPost){
            //echo '<pre style="margin-left:200px;">';
//            print_r($_POST);
//            print_r($_FILES);
//             echo '</pre>';die();
           if ($model->load($_POST) && $model->save()) {
              // print_r($model->attributes);
//               die();
               $model->setTagNames(Yii::$app->request->post('Tags'));
               $model->save();
               // save categories
                $cat_ids = explode(',',Yii::$app->request->post('cat-1'));
//                print_r(Yii::$app->request->post());
                
//                die();
                if(count($cat_ids)){
                    ManufactureSpecialized::deleteAll('MID = '.$model->MID);                    
                    foreach($cat_ids as $id){
                    $category = new ManufactureSpecialized();
                    $category->MID = $model->MID;
                    $category->SpID = $id;
                    $category->save();
                    }
                }
               
                return $this->redirect(Url::previous());
          }else{
              return $this->render('update', [
                    'model' => $model,
              ]);
          }  
        }
		else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Manufactures model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($MID)
	{
		$this->findModel($MID)->delete();
		return $this->redirect(Url::previous());
	}

	/**
	 * Finds the Manufactures model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Manufactures the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($MID)
	{
		if (($model = Manufactures::findOne($MID)) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
    
    public function actionUploadImage() {
            $script_url =  Yii::getAlias('@script_url'); //'http://localhost/howtube/';
            $upload_dir =  Yii::getAlias('@root_name')."/resources/manufactures/";// 'C:/xampp/htdocs/howtube/temp/images/';
            $upload_url =  Yii::getAlias('@script_url').'resources/manufactures/';

            $options = array(
                'script_url' => $script_url,
                'upload_dir' => $upload_dir,
                'upload_url' => $upload_url,
                'param_name' => 'Manufacture_image',
            );
            
            $upload_handler = new UploadHandler($options, true);
            $result_json = $upload_handler->do_upload();
            $result = json_decode($result_json);
            print_r($result_json);
            Yii::$app->end();
    }
}
