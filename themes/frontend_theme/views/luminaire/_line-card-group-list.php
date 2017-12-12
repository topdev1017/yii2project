<?php 
use yii\widgets\ListView;

use backend\models\Manufactures;

$filters = Manufactures::createABCFilters($dataProvider);
echo ListView::widget([
    'dataProvider' => $dataProvider,
    //        'id' => '',
    'options' => [
        'tag' => 'ul',
        'class' => 'results'
    ],
    'itemOptions' => [
        'class' => 'item',
        'tag' => 'li'
    ],
    'emptyTextOptions' => [
        'tag' => 'li',
        'class' => 'no-results'
    ],
    'itemView' => '_line-card-group-item',
    'viewParams' => [
        'filters' => $filters,
        'params' => $params
    ],
    'summary' => '',
]);


?>