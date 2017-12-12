<?php

use yii\helpers\Html;
use yii\helpers\Url;
//use yii\grid\GridView;
use himiklab\sortablegrid\SortableGridView;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
* @var backend\models\SliderImagesSearch $searchModel
*/

    $this->title = 'Slider Images';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="slider-images-index">

    <?php //     echo $this->render('_search', ['model' =>$searchModel]);
    ?>

    <div class="clearfix">
        <p class="pull-left">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' . 'New' . ' Slider Images', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <div class="pull-right">


                        
            <?= 
            \yii\bootstrap\ButtonDropdown::widget(
                [
                    'id'       => 'giiant-relations',
                    'encodeLabel' => false,
                    'label'    => '<span class="glyphicon glyphicon-paperclip"></span> ' . 'Relations',
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

    
        <div class="table-responsive">
        <?= SortableGridView::widget([
        'layout' => '{summary}{pager}{items}{pager}',
        'dataProvider' => $dataProvider,
        'pager'        => [
            'class'          => yii\widgets\LinkPager::className(),
            'firstPageLabel' => 'First',
            'lastPageLabel'  => 'Last'        ],
        'filterModel' => $searchModel,
        'columns' => [

        [
    'class' => 'yii\grid\ActionColumn',
    'urlCreator' => function($action, $model, $key, $index) {
        // using the column name as key, not mapping to 'id' like the standard generator
        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
        $params[0] = \Yii::$app->controller->id ? \Yii::$app->controller->id . '/' . $action : $action;
        return Url::toRoute($params);
    },
    'contentOptions' => ['nowrap'=>'nowrap']
],
			'SliderImagesID',
			'sliderID',
			'imageID',
			'orderID',
			'link',
			'content:ntext',
        ],
    ]); ?>
        </div>

    
</div>
