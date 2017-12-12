<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\dynagrid\DynaGrid;

use backend\models\Categories;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
* @var backend\models\ProductsCategories $searchModel
*/

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="categories-index">

    <?php //     echo $this->render('_search', ['model' =>$searchModel]);
    ?>

    <div class="clearfix">
        <p class="pull-left">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> New Categories', ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('<span class="glyphicon glyphicon-move"></span> Sort Categories', ['sort-categories'], ['class' => 'btn btn-info']) ?>
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

        'CID',
        //			'parent_ID',
        [
            'filter' => Categories::getCategoriesForDropdown(),
            'attribute' => 'parent_ID',
            'value'=>function ($model, $key, $index, $widget) {
                $cat = Categories::findOne($model->parent_ID);
                if($cat) {
                    return $cat->name;
                } else {
                    return $model->parent_ID;
                }
            }
        ],
        'name',
        'slug',
        'description:ntext',
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
    ]]; 

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

        'options'=>['id'=>'categories_grid'] // a unique identifier is important
    ]);
    ?>

</div>
