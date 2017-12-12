<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\dynagrid\DynaGrid;
/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
* @var app\models\PagesSearch $searchModel
*/

$this->title = 'Pages';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="pages-index">

    <?php //     echo $this->render('_search', ['model' =>$searchModel]);
    ?>

    <div class="clearfix">
        <p class="pull-left">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> New Pages', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <div class="pull-right">
                        
            </div>
    </div>

            <?php $columns =[
        
			'PgID',
			'title',
//			'content:ntext',
			'slug',
            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function($action, $model, $key, $index) {
                    // using the column name as key, not mapping to 'id' like the standard generator
                    $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                    $params[0] = \Yii::$app->controller->id ? \Yii::$app->controller->id . '/' . $action : $action;
                    return \yii\helpers\Url::toRoute($params);
                },
                'contentOptions' => ['nowrap'=>'nowrap']
            ],
        ];
     echo DynaGrid::widget([
        'columns'=>$columns,
        'storage'=>DynaGrid::TYPE_COOKIE,
        'theme'=>'panel-danger',
        'enableMultiSort' =>true,
        'gridOptions'=>[
            'dataProvider'=>$dataProvider,
            'filterModel'=>$searchModel,
            'pjax'=>true,
            'floatHeader'=>true,
            'toolbar' =>  [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>'Reset Grid'])
                ],
            ]
        ],
        
        'options'=>['id'=>'pages_grid'] // a unique identifier is important
        ]);
    
    ?>
    
</div>
