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
//                    print_r($slide->attributes);
                ?>
                <div class="slide">
                    <?php 
                    if(!empty($slide->link)) { 
                        ?><a href="<?php echo $slide->link?>" target="<?php echo (strpos($slide->link,"wfli.com") ? "" : "_blank")?>"><?php 
                    }
                    ?>
                    <img src="<?=Yii::getAlias('@web');?>/resources/images/<?=$slide->image->file;?>" style="width: 100%;">
                    <?php 
                    if(!empty($slide->link)) { 
                        ?></a><?php 
                    }
                    ?>
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
            'auto':true,
            'pause':8000,
            'maxSlides': 1,
            'startSlide':0,
            'preloadImages': 'all'
//            'adaptiveHeight': true,
        });
    
    <?php } ?> 
    
    });
</script>
<div class="clear"></div>