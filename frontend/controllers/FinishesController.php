<?php

namespace backend\controllers;

use backend\models\Finishes;
use backend\models\FinishesSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * FinishesController implements the CRUD actions for Finishes model.
 */
class FinishesController extends Controller
{
	/**
	 * Lists all Finishes models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new FinishesSearch;
		$dataProvider = $searchModel->search($_GET);

        Url::remember();
		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single Finishes model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($FID)
	{
        Url::remember();
        return $this->render('view', [
			'model' => $this->findModel($FID),
		]);
	}

	/**
	 * Creates a new Finishes model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Finishes;

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
	 * Updates an existing Finishes model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($FID)
	{
		$model = $this->findModel($FID);

		if ($model->load($_POST) && $model->save()) {
            return $this->redirect(Url::previous());
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Finishes model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($FID)
	{
		$this->findModel($FID)->delete();
		return $this->redirect(Url::previous());
	}

	/**
	 * Finds the Finishes model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Finishes the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($FID)
	{
		if (($model = Finishes::findOne($FID)) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
}
