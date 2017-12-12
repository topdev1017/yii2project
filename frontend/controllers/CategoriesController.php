<?php

namespace backend\controllers;

use backend\models\Categories;
use backend\models\ProductsCategories;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * CategoriesController implements the CRUD actions for Categories model.
 */
class CategoriesController extends Controller
{
	/**
	 * Lists all Categories models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new ProductsCategories;
		$dataProvider = $searchModel->search($_GET);

        Url::remember();
		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single Categories model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($CID)
	{
        Url::remember();
        return $this->render('view', [
			'model' => $this->findModel($CID),
		]);
	}

	/**
	 * Creates a new Categories model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Categories;

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
	 * Updates an existing Categories model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($CID)
	{
		$model = $this->findModel($CID);

		if ($model->load($_POST) && $model->save()) {
            return $this->redirect(Url::previous());
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Categories model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($CID)
	{
		$this->findModel($CID)->delete();
		return $this->redirect(Url::previous());
	}

	/**
	 * Finds the Categories model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Categories the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($CID)
	{
		if (($model = Categories::findOne($CID)) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
    
    public function actionCategoryList($search = null, $id = null) {
        $out = ['more' => false];
        if (!is_null($search)) {
            $query = new Query;
            $query->select('CID, name AS text')
                ->from('categories')
                ->where('name LIKE "%' . $search .'%"')
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
            }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Categories::find($id)->name];
        }
        else {
            $out['results'] = ['id' => 0, 'text' => 'No matching records found'];
        }
        echo Json::encode($out);
    }
}
