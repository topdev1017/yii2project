<?php 
if($model['no_iframe'] > 0) {
    ?>
    <a href="<?=$model['url']?>" target="_blank">
    <?php
} else {
    ?>
    <a href="<?=Yii::$app->urlManager->createUrl(['site/external-url','url'=>$model['url']])?>" target="_blank">
    <?php
}
?>

<?php 
if(!empty($model->image)) {
    $image = Yii::getAlias('@web')."/../../resources/manufactures/".$model['image'];
    ?>
    <img src="<?=$image?>">
    <?php
} else {
    echo $model->name;
}
?>
</a>