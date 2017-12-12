<?php

namespace backend\controllers;

use backend\models\Images;
use backend\models\Sliders;
use backend\models\SlidersSearch;
use backend\models\SliderImages;
use backend\models\SliderImagesSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii;

/**
 * SlidersController implements the CRUD actions for Sliders model.
 */
class SlidersController extends Controller
{
	/**
	 * Lists all Sliders models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new SlidersSearch;
		$dataProvider = $searchModel->search($_GET);

        Url::remember();
		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single Sliders model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($SliderID)
	{
        Url::remember();
        return $this->render('view', [
			'model' => $this->findModel($SliderID),
		]);
	}

	/**
	 * Creates a new Sliders model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Sliders;
        

		try {
            if ($model->load($_POST) && $model->save()) {
                return $this->redirect(Yii::$app->urlManager->createUrl(['sliders/update', 'SliderID'=>$model->SliderID]));
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
	 * Updates an existing Sliders model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($SliderID)
	{
		$model = $this->findModel($SliderID);
        $imagesSearch = new SliderImagesSearch;

		if ($model->load($_POST) && $model->save()) {
            return $this->redirect(Url::previous());
		} else {
            Url::remember();
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Sliders model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($SliderID)
	{
		$this->findModel($SliderID)->delete();
		return $this->redirect(Url::previous());
	}

	/**
	 * Finds the Sliders model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Sliders the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($SliderID)
	{
		if (($model = Sliders::findOne($SliderID)) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
    
    public function actionSort(){
        if(Yii::$app->request->isPost) {
            $items = Yii::$app->request->post('items');
            
            if(!empty($items) && count(json_decode($items)) > 0) {
                $items = (array) json_decode($items);
                
                $i = 0;
                $count = count($items);
                $first = SliderImages::findOne(array_keys($items)[0]);
                echo "first is: ".$first->SliderImagesID." (".$first->orderID.")";
                echo "\n";
                echo "\n";
                foreach($items as $item => $val) {
                    $slide = SliderImages::findOne($item);
                    $otherSlide = SliderImages::findOne($val);
                    if($slide && $otherSlide && $i < ($count - 1)) {
                        echo "Changing #".$slide->SliderImagesID."(".$slide->orderID.") to ".$otherSlide->orderID;
                        echo "\n";
                        $slide->orderID = $otherSlide->orderID;
                        $slide->save(false);
                    }
                    $i++;
                }
                echo "\n";
                $last = SliderImages::findOne(end(array_keys($items)));
                echo "last is: ".$last->SliderImagesID." (".$last->orderID.")";
                echo "\n";
                echo "Changing #".$last->SliderImagesID."(".$last->orderID.") to ".$first->orderID;
                echo "\n";
                $last->orderID = $first->orderID;
                $last->save(false);
                
                
                
            }
        }
    }
    
    
}
