<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\dynagrid\DynaGrid;

use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
* @var app\models\ImagesSearch $searchModel
*/

$this->title = 'Images';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="images-index">

    <?php //     echo $this->render('_search', ['model' =>$searchModel]);
    ?>

    <div class="clearfix">
        <p class="pull-left">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> New Images', ['create'], ['class' => 'btn btn-success']) ?>
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

      <?      
        $columns = [
			    'ImgID',
			    'file',
			    'embed:ntext',
			    'caption:ntext',
                'type',
			    //[
//                    'attribute'=>'type', 
//                    'vAlign'=>'bottom',
//                    'width'=>'190px',
//                    'value'=>function($model){
//                        return $model->type;
//                    },
//                    'filterType'=>GridView::FILTER_SELECT2,
//                    'filter'=>ArrayHelper::map(['image' => 'Image', 'video'=>'Video'], ''), 
//                    'filterWidgetOptions'=>[
//                        'pluginOptions'=>['allowClear'=>true],
//                    ],
//                    'filterInputOptions'=>['placeholder'=>'Any Category'],
//                    'format'=>'raw'
//                ],
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
        
        'options'=>['id'=>'images_grid'] // a unique identifier is important
        ]);
    ?>
    
</div>
