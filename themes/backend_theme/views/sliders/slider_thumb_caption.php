<?php
use frontend\assets\SlidersAsset;
use backend\models\SliderImages;

$assetManager = new SlidersAsset;
$assetManager->register($this);

$uniqid = uniqid();
$slides = $model->sliderImages;
?>
<?php if($slides && count($slides) > 0) { ?>
<div class="slider_thumb_caption">
    <div class="slider">
        <ul class="bxslider_<?=$uniqid?>">
            <?php
                $i = 0;
                foreach($slides as $slide) {
                    if($slide->image && !empty($slide->image)) {
                    ?>
                    <li <?=($i == 0 ? 'style="display:block"' : '')?>>
                        <?php if(!empty($slide->link)) { ?>
                            <a href="<?=$slide->link?>">
                        <?php } ?>
                        <?php 
                        if($slide->image->type == "image") {
                            ?>
                            <img src="<?=Yii::getAlias('@web');?>/resources/images/<?=$slide->image->file;?>">
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
                        
                        <?php if(!empty($slide->link)) { ?>
                            </a>
                        <?php } ?>
                    </li>
                    <?php
                    }
                }
            ?>
        </ul>
        <div class="pager">
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
            <div class="pager-info">Click on Larger Image to Learn More</div>
        </div>
    </div>
    <div class="info">
        <div class="slide-info">
            <?php
                $i = 0;
                foreach($slides as $slide) {
                    if($slide->image && !empty($slide->image)) {
                        ?>
                        <div class="slide <?=($i ==0 ? 'active' : '')?>">
                            <?php echo $slide->content ?>
                        </div>
                        <?php
                        $i++;
                    }
                }
            ?>
        </div>
        <div class="help">
            <a href="javascript:void(0)" class="question-popup">
                <span>Have a question?</span><br>
                Let us help! Click here
            </a>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    var sliderSelector = ".bxslider_<?=$uniqid?>";
    $(sliderSelector).bxSlider({
      pagerCustom: $(sliderSelector).parent().find(".pager"),
      adaptiveHeight: true,
      minSlides: 1,
      maxSlides: 1,
      startSlide:0,
    }).on("bxslider:change",function(event, params) {
        var slider = $(this).closest(".slider_thumb_caption");
        slider.find(".slide-info .slide").hide();
        slider.find(".slide-info .slide").eq(params.slideIndex).show();
    })
})
</script>
<?php } ?>