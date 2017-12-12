<?php

namespace backend\controllers;

use backend\models\Specialized;
use backend\models\SpecializedSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * SpecializedController implements the CRUD actions for Specialized model.
 */
class SpecializedController extends Controller
{
	/**
	 * Lists all Specialized models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new SpecializedSearch;
		$dataProvider = $searchModel->search($_GET);

        Url::remember();
		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single Specialized model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($SpID)
	{
        Url::remember();
        return $this->render('view', [
			'model' => $this->findModel($SpID),
		]);
	}

	/**
	 * Creates a new Specialized model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Specialized;

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
	 * Updates an existing Specialized model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($SpID)
	{
		$model = $this->findModel($SpID);

		if ($model->load($_POST) && $model->save()) {
            return $this->redirect(Url::previous());
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Specialized model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($SpID)
	{
		$this->findModel($SpID)->delete();
		return $this->redirect(Url::previous());
	}

	/**
	 * Finds the Specialized model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Specialized the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($SpID)
	{
		if (($model = Specialized::findOne($SpID)) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
}
