<?php

namespace backend\controllers;

use Yii;
use backend\models\ProductCategories;
use backend\models\ProductSizes;
use backend\models\ProductFinishes;
use backend\models\Products;
use backend\models\ProductsSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\db\ActiveRecord;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
{
	/**
	 * Lists all Products models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new ProductsSearch;
		$dataProvider = $searchModel->search($_GET);

        Url::remember();
		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single Products model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($PID)
	{
        Url::remember();
        return $this->render('view', [
			'model' => $this->findModel($PID),
		]);
	}

	/**
	 * Creates a new Products model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Products;

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
	 * Updates an existing Products model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($PID)
	{
		$model = $this->findModel($PID);
        if(Yii::$app->request->isPost){
              //  echo '<pre style="margin-left:200px;">';
//            print_r($_POST);
//             echo '</pre>';die();
            if ($model->load($_POST) && $model->save()) {
                
                // save categories
                $cat_ids = explode(',',Yii::$app->request->post('cat-1'));
                if(count($cat_ids)){
                    ProductCategories::deleteAll('PID = '.$model->PID);                    
                    foreach($cat_ids as $id){
                    $category = new ProductCategories();
                    $category->PID = $model->PID;
                    $category->CID = $id;
                    $category->save();
                    }
                }
                
                // save Sizes
                $cat_ids = explode(',',Yii::$app->request->post('sizes-1'));
                if(count($cat_ids)){
                    ProductSizes::deleteAll('PID = '.$model->PID);                    
                    foreach($cat_ids as $id){
                    $category = new ProductSizes();
                    $category->PID = $model->PID;
                    $category->SID = $id;
                    $category->save();
                    }
                }
                
                // save Finishes
                $cat_ids = explode(',',Yii::$app->request->post('finish-1'));
                if(count($cat_ids)){
                    ProductFinishes::deleteAll('PID = '.$model->PID);                    
                    foreach($cat_ids as $id){
                    $category = new ProductFinishes();
                    $category->PID = $model->PID;
                    $category->FID = $id;
                    $category->save();
                    }
                }
                
                
                return $this->redirect(Url::previous());
            }else{
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
            
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Products model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($PID)
	{
		$this->findModel($PID)->delete();
		return $this->redirect(Url::previous());
	}

	/**
	 * Finds the Products model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Products the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($PID)
	{
		if (($model = Products::findOne($PID)) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
    
    public function actionUploadImage() {
            $script_url =  Yii::getAlias('@script_url'); //'http://localhost/howtube/';
            $upload_dir =  Yii::getAlias('@root_name')."/resources/products/";// 'C:/xampp/htdocs/howtube/temp/images/';
            $upload_url =   Yii::getAlias('@script_url').'/resources/products/';

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
}
