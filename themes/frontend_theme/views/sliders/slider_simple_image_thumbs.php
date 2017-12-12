<?php
use frontend\assets\SlidersAsset;
use backend\models\SliderImages;

$assetManager = new SlidersAsset;
$assetManager->register($this);

$uniqid = uniqid();
$slides = $model->getSliderImages()->orderBy('orderID ASC')->all();
?>
<?php if($slides && count($slides) > 0) { ?>
    <div class="slider_simple_image_thumbs">
        <div class="slides bxslider_<?=$uniqid?>">
            <?php
            foreach($slides as $slide) {
                if($slide->image && !empty($slide->image)) {
                    ?>
                    <div class="slide">
                        <a href="javascript:void(0)" class="view-large">
                            <?php 
                            if($slide->image->type == "image") {
                                ?>
                                <img src="<?=Yii::getAlias('@web');?>/resources/images/<?=$slide->image->file;?>" title="<?=$slide->image->caption?>">
                                <?php
                            } else {
                                /*$youtube = false;
                                $vimeo = false;
                                if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $id)) {
                                $values = $id[1];
                                } else if (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $id)) {
                                $values = $id[1];
                                } else if (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $url, $id)) {
                                $values = $id[1];
                                } else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $id)) {
                                $values = $id[1];
                                } else {
                                // not youtube video
                                }*/
                                echo $slide->image->embed;
                            }
                            ?>
                            <span class="overlay">
                                <span class="content">
                                    <span class="icon"></span>
                                    <span class="text">Click to <span>enlarge</span></span>
                                </span>
                            </span>
                        </a>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <div class="pager pager-slider">
            <?php
            $i = 0;
            foreach($slides as $slide) {
                if($slide->image && !empty($slide->image)) {
                    ?>
                    <a data-slide-index="<?=$i?>" href="javascript:void(0)">
                        <?php 
                        if($slide->image->type == "image") {
                            ?>
                            <img src="<?=Yii::getAlias('@web');?>/resources/images/<?=$slide->image->file;?>">
                            <?php
                        } else {
                            ?>
                            <img src="<?=Yii::$app->view->theme->baseUrl;?>/resources/images/core/slide-video-image.png">
                            <?php

                        }
                        ?>

                    </a>


                    <?php
                    $i++;
                }
            }
            ?>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            var sliderSelector = ".bxslider_<?=$uniqid?>";
            $(sliderSelector).bxSlider({
                minSlides: 1,
                maxSlides: 1,
                pagerCustom: $(sliderSelector).parent().find(".pager"),
                adaptiveHeight: true,
                captions: true,
                controls: false,
                startSlide:0, 
                slideHeight: 510,
                infiniteLoop: false,
            });
            $(sliderSelector).closest(".slider_simple_image_thumbs").find(".pager").bxSlider({
                minSlides: 1,
                maxSlides: 3,
                slideSelector:'a',
                startSlide:0,
                infiniteLoop: false,
                slideWidth: 40, 
                minSlides: 8,
                maxSlides: 8,
                slideMargin: 10,
                pager: false
            }); 
        });
    </script>
    <?php } ?>