<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\dynagrid\DynaGrid;
use backend\models\Tags;
use backend\models\Manufactures;
use backend\models\Specialized;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
* @var backend\models\ManufacturesSearch $searchModel
*/

$this->title = 'Manufactures';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="manufactures-index">

    <?php //     echo $this->render('_search', ['model' =>$searchModel]);
    ?>

    <div class="clearfix">
        <p class="pull-left">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> New Manufactures', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <div class="pull-right">


                        
            <?php 
            echo \yii\bootstrap\ButtonDropdown::widget(
                [
                    'id'       => 'giiant-relations',
                    'encodeLabel' => false,
                    'label'    => '<span class="glyphicon glyphicon-paperclip"></span> Relations',
                    'dropdown' => [
                        'options'      => [
                            'class' => 'dropdown-menu-right'
                        ],
                        'encodeLabels' => false,
                        'items'        => []                    ],
                ]
            );
            ?>        </div>
    </div>

    <?php
    $columns = [
            ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
            'MID',
            'name',
            'url:url',
            'image',
            [
                'attribute'=>'specialized', 
                'vAlign'=>'bottom',
                'width'=>'190px',
                'value'=>function ($model) { 
//                    print_r($model->specialized);
                      $sections = [];
                      if($model->specialized) {
                         foreach($model->specialized as $category) {
                             $sections[] = $category->name;
                         }
                      }
                      return implode(', ', $sections);;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(Specialized::find()->orderBy('name')->asArray()->all(), 'SpID', 'name'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Any Specialized'],
                'format'=>'raw'
            ],
            [
                    'attribute'=>'cost_range', 
                    'vAlign'=>'bottom',
                    'width'=>'190px',
                    'value'=>function ($model, $key, $index, $widget) { 
                        if($model->cost_range) {
                            return $model->showCostName($model->cost_range);
                        }
                    },
                    'filterType'=>GridView::FILTER_SELECT2,
                    'filter'=>Manufactures::getCostRangeArray(), 
                    'filterWidgetOptions'=>[
                        'pluginOptions'=>['allowClear'=>true],
                    ],
                    'filterInputOptions'=>['placeholder'=>'Any Cost'],
                    'format'=>'raw'
                ],
            [
                'attribute'=>'tagNames', 
                'vAlign'=>'bottom',
                'width'=>'190px',
                'value'=>function ($model) { 
                      return $model->getTagNames();
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(Tags::find()->orderBy('name')->asArray()->all(), 'name', 'name'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Any Tag'],
                'format'=>'raw'
            ],
            [
                    'class'=>'kartik\grid\BooleanColumn',
                    'attribute'=>'status', 
                    'vAlign'=>'bottom',
                ],
            /*'created_at',
            'updated_at'*/
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
        $columns2 = [['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
            'MID',
            'name',
            'url:url'];
        
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
        
        'options'=>['id'=>'manufactures_grid'] // a unique identifier is important
        ]);
    
    ?>
    
</div>
