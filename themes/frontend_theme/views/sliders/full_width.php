<?php 
use backend\models\SliderImages;
use backend\models\Images;

frontend\assets\SlidersAsset::register($this);

$slides = SliderImages::find()->where(['sliderID' => $model->SliderID])->orderBy(['orderID'=>'asc'])->all();

if($slides && count($slides) > 0) {
    ?>
    <div class="bxslider">
        <?php
        foreach($slides as $slide) {
            $image = Images::findOne($slide->imageID);
            if($image) {
            ?>
            <div class="slide">
                <a href="#">
                    <!--<img src="<?=$image->file?>">-->
                    <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/homepage/slider/slide-1.jpg">
                </a>
            </div>
            <?php
            }
        }
        ?>
    </div>
    <?php
}
?>

    