<?php

namespace frontend\controllers;

use Yii;
use backend\models\Products;
use backend\models\Categories;
use backend\models\CategoriesSearch;
use backend\models\ProductsSearch;
use backend\models\Manufactures;
use backend\models\ManufacturesSearch;
use yii\helpers\Url;
use backend\models\ApplicationsHelpForm;

use yii\web\HttpException;

class LuminaireController extends \yii\web\Controller
{
    public function actionIndex()
    {
        
        return $this->render('index');
    }
    
    public function actionIndexNew()
    {
        
        return $this->render('index_new');
    }
    
    public function actionView($cat)
    {
        $request = Yii::$app->request;
        
        Url::remember();
        $model = Categories::findOne($cat);
        if($model) {
            $params['CID'] = $model->CID;
            if(Yii::$app->request->isGet) {
                if(Yii::$app->request->get('led')) {
                    $params['led'] = Yii::$app->request->get('led');
                }
                if(Yii::$app->request->get('quick_ship')) {
                    $params['quick_ship'] = Yii::$app->request->get('quick_ship');
                }
            }
//            print_r($params);
            $dataProvider = CategoriesSearch::searchManufacturesForCID($params);
            if ($request->isAjax) {
                return $this->renderPartial('view-ajax',[
                    'model'=>$model,
                    'dataProvider' => $dataProvider,
                    'params' => $params
                ]);
            } else {
                return $this->render('view',[
                    'model'=>$model,
                    'dataProvider' => $dataProvider,
                    'params' => $params
                ]);
            }
            
        } else {
            throw new HttpException(404, 'The requested page does not exist.');
        }
        
    }
    
    public function actionViewManufacture($mid,$cid) {
        $request = Yii::$app->request;
        Url::remember();
        $model = Manufactures::findOne($mid);
        
        $params['MID'] = $model->MID;
        $params['CID'] = $cid;
        if(Yii::$app->request->isGet) {
            if(Yii::$app->request->get('led')) {
                $params['led'] = Yii::$app->request->get('led');
            }
            if(Yii::$app->request->get('quick_ship')) {
                $params['quick_ship'] = Yii::$app->request->get('quick_ship');
            }
        }
        
        $dataProvider = ProductsSearch::searchProductsByManufactureID($params);
        $dataProvider->pagination = false;
        if ($request->isAjax) {
            return $this->renderPartial('//manufactures/_view_list',[
                'manufacture'=>$model,
                'dataProvider'=>$dataProvider,
                'cid'=>$cid
            ]);
        } else {
            return $this->render('//manufactures/view',[
                'model'=>$model,
                'dataProvider'=>$dataProvider,
                'cid'=>$cid
            ]);
        }
    }
    
    public function actionManufactureSearch($mid,$cat)
    {
        $request = Yii::$app->request;
        $model = Manufactures::findOne($mid);
        
        $params['MID'] = $model->MID;
        $params['CID'] = $cat;
        if(Yii::$app->request->isGet) {
            if(Yii::$app->request->get('led')) {
                $params['led'] = Yii::$app->request->get('led');
            }
            if(Yii::$app->request->get('quick_ship')) {
                $params['quick_ship'] = Yii::$app->request->get('quick_ship');
            }
        }
        
        $dataProvider = ProductsSearch::searchProductsByManufactureID($params);
        $dataProvider->pagination = false;
        if ($request->isAjax) {
            return $this->renderPartial('//manufactures/_view_list',[
                'manufacture'=>$model,
                'dataProvider'=>$dataProvider,
                'cid'=>$cat
            ]);
        } else {
            return $this->render('//manufactures/view',[
                'model'=>$model,
                'dataProvider'=>$dataProvider,
                'cid'=>$cat
            ]);
        }

    }
    
    public function actionSearch($cat)
    {
        $model = Categories::findOne($cat);
        if($model) {
            $params['CID'] = $model->CID;
            if(Yii::$app->request->isGet) {
                if(Yii::$app->request->get('led')) {
                    $params['led'] = Yii::$app->request->get('led');
                }
                if(Yii::$app->request->get('quick_ship')) {
                    $params['quick_ship'] = Yii::$app->request->get('quick_ship');
                }
            }
            $dataProvider = CategoriesSearch::searchManufacturesForCID($params);
            return $this->renderPartial('_view_list',[
                'model'=>$model,
                'dataProvider' => $dataProvider,
                'params' => $params
            ]);
        } else {
            throw new HttpException(404, 'The requested page does not exist.');
        }
        
    }
    
    public function actionSearchGroup($mid)
    {
        $model = Categories::findOne(Yii::$app->request->get('cid'));
        $mnf = Categories::findOne($mid);
        if($model) {
            if(Yii::$app->request->isGet) {
                
                $params['MID'] = $mid;
                if(Yii::$app->request->get('led')) {
                    $params['led'] = Yii::$app->request->get('led');
                    $mparams['led'] = Yii::$app->request->get('led');
                }
                if(Yii::$app->request->get('quick_ship')) {
                    $params['quick_ship'] = Yii::$app->request->get('quick_ship');
                    $mparams['quick_ship'] = Yii::$app->request->get('quick_ship');
                }
            }
            $params['CID'] = $model->CID;
            $mparams['CID'] = $model->CID;
            
            $manufactures = CategoriesSearch::searchManufacturesForCID($mparams);
            
            $dataProvider = ProductsSearch::searchProductsByManufactureID($params);
            
            return $this->renderPartial('_item_group_list',[
                'dataProvider' => $dataProvider,
                'params' => $params,
                'manufactures' => $manufactures,
                'model' => $mnf,
            ]);
        }
        
    }
    
    public function actionProductInfo($pid) {
        $model = Products::findOne($pid);
        $target = "";
        if(Yii::$app->request->get('target')) {
            $target = Yii::$app->request->get('target');
        }
        if($model) {
            return $this->renderPartial("_product-info-popup",['model'=>$model,'target'=>$target]);
        } else {
            throw new HttpException(404, 'The requested product does not exist.');
        }
    }
    
    
    public function actionLineCard() {
        Url::remember();
        
        
        $model = new ManufacturesSearch;
        
        if(Yii::$app->request->isGet) {
            $model->load(Yii::$app->getRequest()->getQueryParams());
        }
        $dataProvider = $model->searchManufacturesABC($model->attributes);
        return $this->render("line-card",[
            'model' => $model,
            'params' => $model->attributes,
            'dataProvider' => $dataProvider
        ]);
    }
    
    
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
    public function actionApplicationsHelpPopup()
    {
        $this->enableCsrfValidation = false;
        $model = new ApplicationsHelpForm;
        
        if(Yii::$app->request->isPost) {
            $response = [];
            $model->load(Yii::$app->request->post());
            
            if($model->validate() && $model->sendEmail()) {
                $response = ['status'=> "OK"];
            } else {
                $response = ['status'=> "ERROR",'message'=>$model->getErrors()];
            }
            echo json_encode($response);
        } else {
            return $this->renderPartial('_applications-popup-form',['model'=>$model]);
        }
    }

}
