<?php 
if(!empty($model->image)) {
    $image = Yii::getAlias('@web')."/../../resources/manufactures/".$model['image'];
    ?>
    <div class="image">
        <img src="<?=$image?>">
    </div>
    <div class="manufacture">
    <?php
} else {
    ?>
    <div class="manufacture no-image">
    <?php
}
?>

<h3>
<?php 
if($model['no_iframe'] > 0) {
    ?>
    <a href="<?=$model['url']?>" target="_blank"><?=$model['name']?></a>
    <?php
} else {
    ?>
    <a href="<?=Yii::$app->urlManager->createUrl(['site/external-url','url'=>$model['url'],"target"=>'manufacture-group_'.($params['letter'] == "#" ? "numeric" : $params['letter'])])?>" target="_blank"><?=$model['name']?></a>
    <?php
}
?>


</h3>
<?php 
if(isset($model->tagsNames) && !empty($model->tagsNames)) {
    $tags = [];
    foreach($model->tagsNames as $i => $tag) {
        $name = ($tag->name);
        if($i == 0) {
           $name = ucfirst($name);
        }
        array_push($tags,$name);
    }
    $text = implode(", ",$tags);
    ?>
    <p><?=$text?></p>
    <?php
}
?>
</div>