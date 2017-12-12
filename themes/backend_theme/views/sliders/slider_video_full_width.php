<?php
use frontend\assets\SlidersAsset;
use backend\models\SliderImages;

$assetManager = new SlidersAsset;
$assetManager->register($this);

$uniqid = uniqid();
$slides = $model->sliderImages;
?>
<?php if($slides && count($slides) > 0) { ?>
<div class="slider_video_full_width">
    <div class="header">
        <h3>
            <?=$model->description?>
        </h3>
        <?php 
        if(!empty($model->video_button)) {
            ?>
            <a target="_blank" href="<?=$model->video_button?>" class="watch-video view-video">Watch Video</a>
            <?php
        }
        ?>
    </div>

    <?php 
    if($slides && count($slides) > 0) {
        ?>
        <div class="slider bxslider_<?=$uniqid?>">
            <?php 
            foreach($slides as $slide) {
                if($slide->image && !empty($slide->image)) {
                ?>
                <div class="slide">
                    <img src="<?=Yii::getAlias('@web');?>/resources/images/<?=$slide->image->file;?>">
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
            'pager':false
        });
    
    <?php } ?> 
    
    });
</script>