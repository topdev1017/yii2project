<?php

namespace backend\controllers;

use Yii;
use backend\models\Pages;
use backend\models\PagesSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * PagesController implements the CRUD actions for Pages model.
 */
class PagesController extends Controller
{
	/**
	 * Lists all Pages models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new PagesSearch;
		$dataProvider = $searchModel->search($_GET);

        Url::remember();
		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single Pages model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($PgID)
	{
        Url::remember();
        return $this->render('view', [
			'model' => $this->findModel($PgID),
		]);
	}
    
    public function actionPreview($id=0) {
        $this->layout = "frontend";
        
        Yii::$app->view->theme->baseUrl = Yii::$app->view->theme->baseUrl."/../../frontend_theme";
        Yii::$app->homeUrl = Yii::getAlias("@script_url");

        if($id < 1) {
            $model = new Pages;
            $model->load($_POST);
        } else {
            $model = $this->findModel($id);
            
            if(isset($_POST['Pages']['content'])) {
                $model->content = $_POST['Pages']['content'];
            }
        }
        
        $model->parseContent();
        
        return $this->render('preview', ['model' => $model,]);
    }
    
	/**
     * Creates a new Pages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pages;
        $model->created_at = date("Y-m-d H:i:s");
        try {
            if ($model->load($_POST) && $model->save()) {
                //print_r($model->attributes);
//                print_r($model->getErrors());
//                echo 'a trecut';
//                die();
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
     * Updates an existing Pages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($PgID)
    {
        $model = $this->findModel($PgID);

        if ($model->load($_POST) && $model->save()) {
            $model->updated_at = date("Y-m-d H:i:s");
            $model->save(false);
            return $this->redirect(Url::previous());
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

	/**
	 * Deletes an existing Pages model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($PgID)
	{
		$this->findModel($PgID)->delete();
		return $this->redirect(Url::previous());
	}

	/**
	 * Finds the Pages model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Pages the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($PgID)
	{
		if (($model = Pages::findOne($PgID)) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
}
