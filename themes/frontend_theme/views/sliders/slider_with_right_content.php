<?php
use frontend\assets\SlidersAsset;
use backend\models\SliderImages;

$assetManager = new SlidersAsset;
$assetManager->js = array_merge($assetManager->js,['js/sliders/slider_with_right_content.js']);
$assetManager->register($this);

$uniqid = uniqid();

$slides = $model->getSliderImages()->orderBy('orderID ASC')->all();
?>

<div class="slider_with_right_content">
    <?php 
    if($slides && count($slides) > 0) {
        ?>
        <div class="slider"> 
            <div class="bxslider_<?=$uniqid?>">
                <?php
                foreach($slides as $slide) {
                    if($slide->image && !empty($slide->image)) {
                        ?>
                        <div class="slide">
                            <?php 
                            if(!empty($slide->link)) {?>
                                <a href="<?=$slide->link?>">
                            <?php } ?>
                                <img src="<?=Yii::getAlias('@web');?>/resources/images/<?=$slide->image->file;?>">
                            <?php if(!empty($slide->link)) {?>
                                </a>
                            <?php } ?>
                        </div>

                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <?php
    }
    ?>

    <div class="featured">
        <?=$model->description?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".bxslider_<?=$uniqid?>").bxSlider({
            'pager':false,
            'speed':1000,
            'auto':true
        });
    })
</script>
