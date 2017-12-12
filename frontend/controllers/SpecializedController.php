<?php

namespace frontend\controllers;

use Yii;
use backend\models\Products;
use backend\models\Categories;
use backend\models\SpecializedSearch;

use yii\web\HttpException;
use yii\helpers\Url;

class SpecializedController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new SpecializedSearch;
        $dataProvider = $model->search([]);
        $dataProvider->pagination = false;
        
        Url::remember();
        
        return $this->render("index",['dataProvider' => $dataProvider]);
    }

}
