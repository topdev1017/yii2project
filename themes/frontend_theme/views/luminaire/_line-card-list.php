<?php 
use yii\widgets\ListView;
use yii\widgets\Pjax;


Pjax::begin([
    //    'id' => 'manuf_'.uniqid(),
    'enablePushState' => false,
    'timeout' => 2000,
    'options' => [
        'class' => 'pajax-container',
    ]
]);


echo ListView::widget([
    'dataProvider' => $dataProvider,
    //        'id' => '',
    'options' => [
        'tag' => 'ul',
        'class' => 'result-list'
    ],
    'itemOptions' => [
        'class' => 'item',
        'tag' => 'li'
    ],
    'emptyTextOptions' => [
        'tag' => 'li',
        'class' => 'no-results'
    ],
    'itemView' => '_line-card-list-item',
    'viewParams' => [
        'params' => $params
    ],
    'summary' => '',
]);

Pjax::end()
?>