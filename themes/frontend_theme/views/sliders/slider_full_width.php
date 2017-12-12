<?php
use frontend\assets\SlidersAsset;
use backend\models\SliderImages;

$assetManager = new SlidersAsset;
$assetManager->register($this);

$uniqid = uniqid();
$slides = $model->getSliderImages()->orderBy('orderID ASC')->all();
?>
<?php if($slides && count($slides) > 0) { ?>
<div class="slider_full_width">

    <?php 
    if($slides && count($slides) > 0) {
        ?>
        <div class="slider bxslider_<?=$uniqid?>">
            <?php 
            foreach($slides as $slide) {
                if($slide->image && !empty($slide->image)) {
                ?>
                <div class="slide">
                    <img src="<?=Yii::getAlias('@web');?>/resources/images/<?=$slide->image->file;?>" style="width: 100%;">
                </div>
                <?php 
                } 
            }
            ?>
        </div>

    <?php } ?>
</div>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function() {
    <?php if($slides && count($slides) > 1) { ?>
    
        $(".bxslider_<?=$uniqid?>").bxSlider({
            'pager':false,
            'minSlides': 1,
            'maxSlides': 1,
            'startSlide':0,
            'preloadImages': 'all'
//            'adaptiveHeight': true,
        });
    
    <?php } ?> 
    
    });
</script>
<div class="clear"></div>