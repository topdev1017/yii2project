<?php

namespace backend\modules\importcsv\controllers;

use yii\web\Controller;
use backend\modules\importcsv\models\ImportCsv;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        
        $model = new ImportCsv;
        return $this->render('index',['model'=>$model,'module'=>$this->module]);
    }
}
