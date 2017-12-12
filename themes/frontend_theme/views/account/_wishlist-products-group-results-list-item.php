<?php 
    if(!empty($model['image']) && is_file(Yii::$app->basePath."/../resources/products/".$model['image'])) {
        $image = Yii::getAlias('@web')."/../../resources/products/".$model['image'];
    } else {
        $image = Yii::$app->view->theme->baseUrl."/resources/images/luminaire-selector/thumbs-middle.jpg";
    }
?>
<p class="show-product-info" data-pid="<?=$model['PID']?>"><?=$model['name']?></p>
<div class="thumb show-product-info" data-pid="<?=$model['PID']?>">
    <img src="<?=$image?>">
</div>
<div class="specifications show-product-info" data-pid="<?=$model['PID']?>">
    <?php 

    //$specs = $model->getSpecs();
    if($model->led == 1 && $model->quick_ship == 1){
        echo 'Led + Quick Ship';
    }elseif($model->led == 1){
        echo 'Led';
    }elseif($model->quick_ship == 1){
        echo 'Quick Ship';
    }else{
        echo 'More info';
    }
    ?>
</div>
<a href="#" class="remove-item remove-from-wishlist" data-pid="<?=$model['PID']?>">Remove Item</a>