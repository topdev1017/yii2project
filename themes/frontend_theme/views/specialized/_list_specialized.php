<?php 
use yii\widgets\ListView;

    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => [
            'tag' => 'ul',
            'class' => 'specialized-group'
        ],
        'itemOptions' => [
            'class' => 'item',
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
        'itemView' => '_list_specialized-item',
        'viewParams' => [
        ],
        'summary' => '',
    ]);

?>