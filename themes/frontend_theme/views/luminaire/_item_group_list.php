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
    if($dataProvider->totalCount > $dataProvider->pagination->pageSize) {
        $beforePager = "<h3><a href=\"".Yii::$app->UrlManager->createUrl(['luminaire/view-manufacture','mid'=>$model['MID'],'cid'=>$params['CID']])."\">More products from <span>".$model['name']."</span></a></h3>";
        $afterPager = "<div class='group-pager-show-all'><a href=\"".Yii::$app->UrlManager->createUrl(['luminaire/view-manufacture','mid'=>$model['MID'],'cid'=>$params['CID']])."\">Show All</a></div>";
    } else {
        $beforePager = "";
        $afterPager = "";
    }
    
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
//        'layout' => "{summary}\n{items}\n<li class='group-pager-wrap'><h3>More products from <span>".$model['name']."</span></h3>{pager}</li>",
        'layout' => "{summary}\n{items}\n<li class='group-pager-wrap'>".$beforePager."{pager}".$afterPager."</li>",
        'itemView' => '_item_group_product',
        'viewParams' => [
    //        'MID' => $model['MID'],
            'manufactures' => $manufactures,
            'params' => $params
        ],
        'summary' => '',
    ]);

//Pjax::end();


?>