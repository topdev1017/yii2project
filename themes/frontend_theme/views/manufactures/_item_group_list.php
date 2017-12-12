<?php 
use yii\widgets\ListView;
use yii\widgets\Pjax;

/*Pjax::begin([
//    'id' => 'manuf_'.uniqid(),
    'enablePushState' => false,
//    'timeout' => 2000,
    'options' => [
        'class' => 'pajax-container',
    ]
]);*/
    
    
    echo ListView::widget([
        'dataProvider' => $dataProvider,
//        'id' => '',
        'options' => [
            'tag' => 'ul',
            'class' => 'products-group'
        ],
        'itemOptions' => [
            'class' => 'item product-box '.Yii::$app->session->get('ls-products-size','medium'),
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
//        'layout' => "{summary}\n{items}\n<li class='group-pager-wrap'><h3>More products from <span>".$model['name']."</span></h3>{pager}</li>",
        'layout' => "{summary}\n{items}\n<li class='group-pager-wrap'>{pager}</li>",
        'itemView' => '_item_group_product',
        
        'summary' => '',
    ]);

//Pjax::end();
?>