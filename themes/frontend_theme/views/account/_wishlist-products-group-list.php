<?php 
    use yii\widgets\ListView;
    
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'id' => 'wishlist_products_group',
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
        'itemView' => '_wishlist-products-group-list-item',
        'viewParams' => [
            'manufactures' => $dataProvider->getModels(),
            'params'=>$params
        ],
        'summary' => '',
    ]);
?>