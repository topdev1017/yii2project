<?php

namespace backend\controllers;

use backend\models\Sizes;
use backend\models\SizesSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * SizesController implements the CRUD actions for Sizes model.
 */
class SizesController extends Controller
{
	/**
	 * Lists all Sizes models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new SizesSearch;
		$dataProvider = $searchModel->search($_GET);

        Url::remember();
		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single Sizes model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($SID)
	{
        Url::remember();
        return $this->render('view', [
			'model' => $this->findModel($SID),
		]);
	}

	/**
	 * Creates a new Sizes model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Sizes;

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
	 * Updates an existing Sizes model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($SID)
	{
		$model = $this->findModel($SID);

		if ($model->load($_POST) && $model->save()) {
            return $this->redirect(Url::previous());
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Sizes model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($SID)
	{
		$this->findModel($SID)->delete();
		return $this->redirect(Url::previous());
	}

	/**
	 * Finds the Sizes model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Sizes the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($SID)
	{
		if (($model = Sizes::findOne($SID)) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
}
