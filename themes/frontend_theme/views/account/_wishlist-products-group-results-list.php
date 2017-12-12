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
            'class' => 'products-group'
        ],
        'itemOptions' => [
            'class' => 'item product-box',
            'tag' => 'li'
        ],
        'emptyTextOptions' => [
            'tag' => 'li',
            'class' => 'no-results'
        ],
        'pager' => [
            'options' => [
                'class' => 'group-pager',
                'data-pjax' => 1
            ]
        ],
        'layout' => "{summary}\n{items}\n<li class='group-pager-wrap'>{pager}</li>",
        'itemView' => '_wishlist-products-group-results-list-item',
        'viewParams' => [
    //        'MID' => $model['MID'],
//            'manufactures' => $manufactures,
//            'params' => $params
        ],
        'summary' => '',
    ]);

Pjax::end()
?>