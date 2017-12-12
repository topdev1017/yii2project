<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\dynagrid\DynaGrid;

use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use kartik\sortinput\SortableInput;
use kartik\widgets\Select2;

use backend\models\Categories;
use backend\models\Manufactures;
use backend\models\Sizes;
use backend\models\Products;
use backend\models\Finishes;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
* @var backend\models\ProductsSearch $searchModel
*/

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="products-index">

    <?php //     echo $this->render('_search', ['model' =>$searchModel]);
    ?>

    <div class="clearfix">
        <p class="pull-left">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> New Products', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <div class="pull-right">
            <?php 
            //echo \yii\bootstrap\ButtonDropdown::widget(
               // [
//                    'id'       => 'giiant-relations',
//                    'encodeLabel' => false,
//                    'label'    => '<span class="glyphicon glyphicon-paperclip"></span> Relations',
//                    'dropdown' => [
//                        'options'      => [
//                            'class' => 'dropdown-menu-right'
//                        ],
//                        'encodeLabels' => false,
//                        'items'        => []                    ],
//                ]
//            );
            ?>        
            </div>
    </div>
    <?
    $columns = [
                ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT, 'vAlign'=>'bottom'],
                [
                 'attribute' => 'PID',
                 'vAlign'=>'bottom',
                ],
                [
                 'attribute' => 'name',
                 'vAlign'=>'bottom',
                ],
                //[
//                 'attribute' => 'description',
//                 'vAlign'=>'bottom',
//                ],
                [
                 'attribute' => 'manufacture_product_url',
                 'vAlign'=>'bottom',
                ],
                [
                 'attribute' => 'slug',
                 'vAlign'=>'bottom',
                ],
                //[
//                 'attribute' => 'image',
//                 'vAlign'=>'bottom',
//                ],
                [
                    'attribute'=>'category', 
                    'vAlign'=>'bottom',
                    'width'=>'190px',
                    'value'=>function ($model) { 
                          $sections = [];
                          if($model->category) {
                             foreach($model->category as $category) {
                                 $sections[] = $category->name;
                             }
                          }
                          return implode(', ', $sections);;
                    },
                    'filterType'=>GridView::FILTER_SELECT2,
                    'filter'=>ArrayHelper::map(Categories::find()->orderBy('name')->asArray()->all(), 'CID', 'name'), 
                    'filterWidgetOptions'=>[
                        'pluginOptions'=>['allowClear'=>true],
                    ],
                    'filterInputOptions'=>['placeholder'=>'Any Category'],
                    'format'=>'raw'
                ],
                [
                    'attribute'=>'manufacture_id', 
                    'vAlign'=>'bottom',
                    'width'=>'190px',
                    'value'=>function ($model, $key, $index, $widget) { 
                        if($model->manufacture) {
                            return $model->manufacture->name;
                        }
                    },
                    'filterType'=>GridView::FILTER_SELECT2,
                    'filter'=>ArrayHelper::map(Manufactures::find()->orderBy('name')->asArray()->all(), 'MID', 'name'), 
                    'filterWidgetOptions'=>[
                        'pluginOptions'=>['allowClear'=>true],
                    ],
                    'filterInputOptions'=>['placeholder'=>'Any Manufacture'],
                    'format'=>'raw'
                ],[
                    'attribute'=>'cost_range', 
                    'vAlign'=>'bottom',
                    'width'=>'190px',
                    'value'=>function ($model, $key, $index, $widget) { 
                        if($model->cost_range) {
                            return $model->showCostName($model->cost_range);
                        }
                    },
                    'filterType'=>GridView::FILTER_SELECT2,
                    'filter'=>Products::getCostRangeArray(), 
                    'filterWidgetOptions'=>[
                        'pluginOptions'=>['allowClear'=>true],
                    ],
                    'filterInputOptions'=>['placeholder'=>'Any Cost'],
                    'format'=>'raw'
                ],
                [
                    'attribute'=>'sizes', 
                    'vAlign'=>'bottom',
                    'width'=>'190px',
                    'value'=>function ($model) { 
                          $sections = [];
                          if($model->size) {
                             foreach($model->size as $size) {
                                 $sections[] = $size->name;
                             }
                          }
                          return implode(', ', $sections);;
                    },
                    'filterType'=>GridView::FILTER_SELECT2,
                    'filter'=>ArrayHelper::map(Sizes::find()->orderBy('name')->asArray()->all(), 'SID', 'name'), 
                    'filterWidgetOptions'=>[
                        'pluginOptions'=>['allowClear'=>true],
                    ],
                    'filterInputOptions'=>['placeholder'=>'Any Size'],
                    'format'=>'raw'
                ],
                [
                    'attribute'=>'finishes', 
                    'vAlign'=>'bottom',
                    'width'=>'190px',
                    'value'=>function ($model) { 
                          $sections = [];
                          if($model->finish) {
                             foreach($model->finish as $size) {
                                 $sections[] = $size->name;
                             }
                          }
                          return implode(', ', $sections);;
                    },
                    'filterType'=>GridView::FILTER_SELECT2,
                    'filter'=>ArrayHelper::map(Finishes::find()->orderBy('name')->asArray()->all(), 'FID', 'name'), 
                    'filterWidgetOptions'=>[
                        'pluginOptions'=>['allowClear'=>true],
                    ],
                    'filterInputOptions'=>['placeholder'=>'Any Size'],
                    'format'=>'raw'
                ],
                [
                    'class'=>'kartik\grid\BooleanColumn',
                    'attribute'=>'status', 
                    'vAlign'=>'bottom',
                ],
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
        
        'options'=>['id'=>'products_grid'] // a unique identifier is important
        ]);
    ?>
</div>
