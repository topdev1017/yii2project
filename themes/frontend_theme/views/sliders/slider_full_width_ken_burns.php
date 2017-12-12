<?php
use frontend\assets\SlidersAsset;
use backend\models\SliderImages;

$assetManager = new SlidersAsset;
$assetManager->register($this);

$uniqid = uniqid();
$slides = $model->getSliderImages()->orderBy('orderID ASC')->all();
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
                        $positions = [
                            [
                                'bgposition' => 'right top',
                                'bgpositionend' => 'right top',
                                'bgfit' => '100',
                                'bgfitend' => '110',
                            ],
                            [
                                'bgposition' => 'left top',
                                'bgpositionend' => 'left top',
                                'bgfit' => '100',
                                'bgfitend' => '110',
                            ],
                            [
                                'bgposition' => 'left bottom',
                                'bgpositionend' => 'left bottom',
                                'bgfit' => '100',
                                'bgfitend' => '110',
                            ],
                            [
                                'bgposition' => 'right bottom',
                                'bgpositionend' => 'right bottom',
                                'bgfit' => '100',
                                'bgfitend' => '110',
                            ],
                            [
                                'bgposition' => 'right top',
                                'bgpositionend' => 'right top',
                                'bgfit' => '110',
                                'bgfitend' => '100',
                            ],
                            [
                                'bgposition' => 'left top',
                                'bgpositionend' => 'left top',
                                'bgfit' => '110',
                                'bgfitend' => '100',
                            ],
                            [
                                'bgposition' => 'left bottom',
                                'bgpositionend' => 'left bottom',
                                'bgfit' => '110',
                                'bgfitend' => '100',
                            ],
                            [
                                'bgposition' => 'right bottom',
                                'bgpositionend' => 'right bottom',
                                'bgfit' => '110',
                                'bgfitend' => '100',
                            ],
                        ];
                        shuffle($positions);
                        foreach($slides as $slide) {
                            if($slide->image && !empty($slide->image)) {
                                $i = rand(0,(count($positions) -1));
                                ?>
                                <li data-transition="boxfade" data-slotamount="1" data-masterspeed="10000" data-delay="10000">
                                    <img src="<?=Yii::getAlias('@web');?>/resources/images/<?=$slide->image->file;?>" 
                                    data-kenburns="on" 
                                    data-duration="9000" 
                                    data-ease="linear" 
                                    data-bgfit="<?=$positions[$i]['bgfit']?>" 
                                    data-bgfitend="<?=$positions[$i]['bgfitend']?>" 
                                    data-bgposition="<?=$positions[$i]['bgposition']?>" 
                                    data-bgpositionend="<?=$positions[$i]['bgpositionend']?>">
                                </li>

                                <?php 
                            } 
                        }
                        ?>
                    </ul>
<!--                    <div class="tp-bannertimer"></div>-->
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

//                    parallax:"mouse",
//                    parallaxBgFreeze:"on",
//                    parallaxLevels:[7,4,3,2,5,4,3,2,1,0],

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

//                    shadow:0,
                    fullWidth:"on",
//                    fullScreen:"off",

                    spinner:"spinner4",

//                    stopLoop:"off",
//                    stopAfterLoops:-1,
//                    stopAtSlide:-1,

                    shuffle:"off",

                    autoHeight:"on",
//                    forceFullWidth:"on",



//                    hideThumbsOnMobile:"off",
//                    hideNavDelayOnMobile:1500,
//                    hideBulletsOnMobile:"off",
//                    hideArrowsOnMobile:"off",
//                    hideThumbsUnderResolution:0,

//                    hideSliderAtLimit:0,
//                    hideCaptionAtLimit:0,
//                    hideAllCaptionAtLilmit:0,
                    startWithSlide:0,
//                    videoJsPath:"rs-plugin/videojs/",
//                    fullScreenOffsetContainer: ""
            });


            <?php } ?> 

    });
</script>
<div class="clear"></div>