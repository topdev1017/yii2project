<?php
use frontend\assets\SlidersAsset;
use backend\models\SliderImages;

$assetManager = new SlidersAsset;
$assetManager->register($this);

$uniqid = uniqid();
$slides = $model->sliderImages;
?>
<?php if($slides && count($slides) > 0) { ?>
    <div class="slider_full_width_ken_burns">

        <?php 
        if($slides && count($slides) > 0) {
            ?>
            <div class="tp-banner-container">
                <div class="tp-banner revolution_slider_<?=$uniqid?>" style="display: none;">
                    <ul>
                        <?php 
                        foreach($slides as $slide) {
                            if($slide->image && !empty($slide->image)) {
                                ?>
                                <li data-transition="boxfade" data-delay="10000" data-saveperformance="on">
                                    <img src="<?=Yii::getAlias('@web');?>/resources/images/<?=$slide->image->file;?>" 
                                    data-bgposition="center center" 
                                    data-bgpositionend="center center"
                                    data-kenburns="on" 
                                    data-duration="20000" 
                                    data-ease="Power0.easeInOut" 
                                    data-bgfit="100" 
                                    data-bgfitend="110">
                                </li>

                                <?php 
                            } 
                        }
                        ?>
                    </ul>
                    <div class="tp-bannertimer"></div>
                </div>
            </div>
            <?php } ?>
    </div>
    <?php } ?>
<script type="text/javascript">
    $(document).ready(function() {
        <?php if($slides && count($slides) > 1) { ?>
            $('.revolution_slider_<?=$uniqid?>').show().revolution(
                {
                    dottedOverlay:"none",
                    delay:10000,
//                    startwidth:1170,
                    startheight:450,
//                    hideThumbs:200,

//                    thumbWidth:100,
//                    thumbHeight:50,
//                    thumbAmount:5,

                    navigationType:"arrows",
                    navigationArrows:"solo",
                    navigationStyle:"preview4",

                    touchenabled:"on",
                    onHoverStop:"off",

                    swipe_velocity: 0.7,
                    swipe_min_touches: 1,
                    swipe_max_touches: 1,
                    drag_block_vertical: false,

                    parallax:"mouse",
                    parallaxBgFreeze:"on",
                    parallaxLevels:[7,4,3,2,5,4,3,2,1,0],

                    keyboardNavigation:"off",

                    navigationHAlign:"center",
                    navigationVAlign:"bottom",
                    navigationHOffset:0,
                    navigationVOffset:20,

                    soloArrowLeftHalign:"left",
                    soloArrowLeftValign:"center",
                    soloArrowLeftHOffset:20,
                    soloArrowLeftVOffset:0,

                    soloArrowRightHalign:"right",
                    soloArrowRightValign:"center",
                    soloArrowRightHOffset:20,
                    soloArrowRightVOffset:0,

                    shadow:0,
                    fullWidth:"on",
                    fullScreen:"off",

                    spinner:"spinner4",

                    stopLoop:"off",
                    stopAfterLoops:-1,
                    stopAtSlide:-1,

                    shuffle:"off",

                    autoHeight:"on",
                    forceFullWidth:"on",



                    hideThumbsOnMobile:"off",
                    hideNavDelayOnMobile:1500,
                    hideBulletsOnMobile:"off",
                    hideArrowsOnMobile:"off",
                    hideThumbsUnderResolution:0,

                    hideSliderAtLimit:0,
                    hideCaptionAtLimit:0,
                    hideAllCaptionAtLilmit:0,
                    startWithSlide:0,
                    videoJsPath:"rs-plugin/videojs/",
                    fullScreenOffsetContainer: ""
            });


            <?php } ?> 

    });
</script>
<div class="clear"></div>