<?php 
    use yii\widgets\ListView;
    
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'id' => 'manufacture_group',
        'options' => [
            'tag' => 'ul',
            'class' => 'products'
        ],
        'itemOptions' => [
            'class' => 'item',
            'tag' => 'li'
        ],
        'emptyTextOptions' => [
            'tag' => 'li',
            'class' => 'no-results'
        ],
        'itemView' => '_item_group',
        'viewParams' => [
            'manufactures' => $dataProvider->getModels(),
            'params'=>$params
        ],
        'summary' => '',
    ]);
?>