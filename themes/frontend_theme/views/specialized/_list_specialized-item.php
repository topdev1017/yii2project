<?php 
use yii\widgets\ListView;

use backend\models\ManufacturesSearch;
?>
<div class="header">
    <h1 id="spec_<?=$model['SpID']?>" class="spec_<?=$model['SpID']?>"><?=$model['name']?></h1>
    <a href="#" class="scroll-top scroll-top-icon" data-target=".page-content">Top</a>
</div>
<div class="manufactures-group">
<?php 
$param['SpID'] = $model['SpID'];

$dataProvider = ManufacturesSearch::searchManufacturesSpecializedByID($param);
echo ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => [
            'tag' => 'ul',
            'class' => 'manufactures-group-list'
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
        'itemView' => '_list_manufacture-item',
        'viewParams' => [
        ],
        'summary' => '',
    ]);
?>
</div>
