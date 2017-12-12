<?php 
use backend\models\ManufacturesSearch
?>
<div class="header">
    <h1 id="manufacture-group_<?=($model['letter'] == "#" ? "numeric" : $model['letter'])?>" class="manufacture-group_<?=($model['letter'] == "#" ? "numeric" : $model['letter'])?>"><?=$model['letter']?></h1>
    <div class="options">
        <div class="filters">
            <a href="#" class="trigger"><span>- Hover for </span>Menu -</a>
            <?=$filters?>
        </div>
        <div class="actions">
            <a href="<?=Yii::$app->request->baseUrl?>/../../resources/wlfi_manufacturer_list.pdf" target="_blank" data-pjax="0" class="pdf"></a>
            <a href="#" class="scroll-top" data-target=".main-content"></a>
        </div>
        <div class="spacer"></div>
    </div>

</div>
<?php 
$params['letter'] = $model['letter'];
$dataProvider = ManufacturesSearch::searchManufacturesByABC($params);
echo $this->render("_line-card-list",['dataProvider' => $dataProvider,'params'=>$params]);
?>