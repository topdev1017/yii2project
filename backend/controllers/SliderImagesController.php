<?php

namespace backend\controllers;

use backend\models\Images;
use backend\models\Sliders;
use backend\models\SliderImages;
use backend\models\SliderImagesSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use dmstr\bootstrap\Tabs;
use himiklab\sortablegrid\SortableGridAction;

/**
 * SliderImagesController implements the CRUD actions for SliderImages model.
 */
class SliderImagesController extends Controller
{
    /**
     * @var boolean whether to enable CSRF validation for the actions in this controller.
     * CSRF validation is enabled only when both this property and [[Request::enableCsrfValidation]] are true.
     */
    public $enableCsrfValidation = false;

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'allow' 	=> true,
						'actions'   => ['index', 'view', 'create', 'update', 'delete', 'insert-image'],
						'roles'     => ['@']
					]
				]
			]
		];
	}

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            return true;
        } else {
            return false;
        }
    }
    
   

    public function actions()
    {
        return [
            'sort' => [
                'class' => SortableGridAction::className(),
                'modelName' => SliderImages::className(),
            ],
        ];
    }
    
    

	/**
	 * Lists all SliderImages models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel  = new SliderImagesSearch;
		$dataProvider = $searchModel->search($_GET);

		Tabs::clearLocalStorage();

        Url::remember();
        \Yii::$app->session['__crudReturnUrl'] = null;

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single SliderImages model.
	 * @param integer $SliderImagesID
     *
	 * @return mixed
	 */
	public function actionView($SliderImagesID)
	{
        $resolved = \Yii::$app->request->resolve();
        $resolved[1]['_pjax'] = null;
        $url = Url::to(array_merge(['/'.$resolved[0]],$resolved[1]));
        \Yii::$app->session['__crudReturnUrl'] = Url::previous();
        Url::remember($url);
        Tabs::rememberActiveState();

        return $this->render('view', [
			'model' => $this->findModel($SliderImagesID),
		]);
	}

	/**
	 * Creates a new SliderImages model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new SliderImages;

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
        return $this->render('create', ['model' => $model]);
	}

	/**
	 * Updates an existing SliderImages model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $SliderImagesID
	 * @return mixed
	 */
	public function actionUpdate($SliderImagesID)
	{
		$model = $this->findModel($SliderImagesID);
        
		if ($model->load($_POST) && $model->save()) {
            $this->redirect(Url::previous());
		} else {
            Url::remember();
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing SliderImages model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $SliderImagesID
	 * @return mixed
	 */
	public function actionDelete($SliderImagesID)
	{
//        die('aaaa');
        try {
            $this->findModel($SliderImagesID)->delete();
//            echo "cucuuuu";
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
            \Yii::$app->getSession()->setFlash('error', $msg);
            return $this->redirect(Url::previous());
        }

        // TODO: improve detection
        $isPivot = strstr('$SliderImagesID',',');
        if ($isPivot == true) {
            $this->redirect(Url::previous());
        } elseif (isset(\Yii::$app->session['__crudReturnUrl']) && \Yii::$app->session['__crudReturnUrl'] != '/') {
			Url::remember(null);
			$url = \Yii::$app->session['__crudReturnUrl'];
			\Yii::$app->session['__crudReturnUrl'] = null;

			$this->redirect($url);
        } else {
            $this->redirect(Url::previous());
//            $this->redirect(['index']);
        }
	}

	/**
	 * Finds the SliderImages model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $SliderImagesID
	 * @return SliderImages the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($SliderImagesID)
	{
		if (($model = SliderImages::findOne($SliderImagesID)) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
    
    
    
    
    
    public function actionInsertImage(){
        $slider = Sliders::findOne($_POST['SliderImages']['SliderID']);
        if($slider){
           $last_slider_image = SliderImages::find()->where('sliderID = '.$_POST['SliderImages']['SliderID'])->orderby('orderID DESC')->one();
           $orderid = 1;
           if($last_slider_image) {
               $orderid = $last_slider_image->orderID+1;
           }
            $sliderImages = new SliderImages;
            $sliderImages->sliderID = $_POST['SliderImages']['SliderID'];
            $sliderImages->imageID = $_POST['SliderImages']['ImgID'];
            $sliderImages->orderID = $orderid;
            if($slider->type == 'slider_thumb_caption'){
                $sliderImages->content = $_POST['SliderImages']['content'];
                $sliderImages->link = $_POST['SliderImages']['link'];
            }
            if($slider->type == 'slider_full_width_with_links'){
                $sliderImages->link = $_POST['SliderImages']['link'];
            }
            if($slider->type == 'slider_full_width' && isset($_POST['SliderImages']['content'])){
                $sliderImages->content = $_POST['SliderImages']['content'];
            }
            $sliderImages->save();
            return true; 
        }else{
           return false;  
        }
        
        // refresh la gridul ala dubios
        
       // if($slider->type != 'slider_thumb_caption'){
//            if($image){
//                echo "<tr><td>-1</td><td><img src='".Yii::getAlias('@script_url').'/resources/images/'.$image->file."' /></td><td><a href='javascript:void(0)' class='btn btn-danger'><span class='glyphicon glyphicon-ban-circle'></span>  Delete</a></td></tr>";
//            }else{
//                echo '';
//            }
//        }else{
//            if($image){
//                echo "<tr><td>-1</td><td><img src='".Yii::getAlias('@script_url').'/resources/images/'.$image->file."' /></td><td><input type='text' name='SlidersImages['link']' /></td><td><input type='text' name='SlidersImages['content']' /></td><td><a href='javascript:void(0)' class='btn btn-danger'><span class='glyphicon glyphicon-ban-circle'></span>  Delete</a></td></tr>";
//            }else{
//                echo '';
//            }
//        }
        
        
    }
}
