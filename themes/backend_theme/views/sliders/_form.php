<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;
use kartik\widgets\FileInput;
use yii\helpers\Url;
use himiklab\sortablegrid\SortableGridView;

use backend\models\SliderImages;
use backend\models\SliderImagesSearch;
use yii\widgets\Pjax;

/**
* @var yii\web\View $this
* @var app\models\Images $model
* @var yii\widgets\ActiveForm $form
*/

?>


<div class="sliders-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]); ?>

    <div class="">
        <?php echo $form->errorSummary($model); ?>
        <?php $this->beginBlock('main'); ?>
        <p>&nbsp;</p>
        <?= $form->field($model, 'name')->textInput(['maxlength' => 250]) ?>
        <? if($model->isNewRecord){
            echo $form->field($model, 'type')->dropDownList([ 
                'slider_full_width' => 'Slider Full Width', 
                'slider_full_width_with_links' => 'Slider Full Width With Links', 
                'slider_full_width_ken_burns' => 'Slider Full Width Ken Burns', 
                'slider_with_right_content' => 'Slider With Right Content Static', 
                'slider_video_full_width' => 'Slider With Small Title and Watch Video Button', 
                'slider_thumb_caption' => 'Slider With Right Content Dynamic', 
                'slider_simple_image_thumbs' => 'Slider With Small Thumbs', 
                ], ['prompt' => 'Choose a type',  ]) ;
        }else{
            echo $form->field($model, 'type')->dropDownList([ 
                'slider_full_width' => 'Slider Full Width', 
                'slider_full_width_with_links' => 'Slider Full Width With Links', 
                'slider_full_width_ken_burns' => 'Slider Full Width Ken Burns', 
                'slider_with_right_content' => 'Slider With Right Content Static', 
                'slider_video_full_width' => 'Slider With Small Title and Watch Video Button', 
                'slider_thumb_caption' => 'Slider With Right Content Dynamic', 
                'slider_simple_image_thumbs' => 'Slider With Small Thumbs', 
                ], ['prompt' => 'Choose a type',  'disabled'=>'true']); 
        }
        ?>

        <div id="link_input" <?if($model->type == 'slider_video_full_width'){?>style="display: block;"<?}else{?>style="display: none;"<?}?>>
            <?= $form->field($model, 'video_button')->textInput(['maxlength' => 250]) ?>
        </div>

        <div id="content_input" <?if(($model->type == 'slider_video_full_width') || ($model->type == 'slider_with_right_content')){?>style="display: block;"<?}else{?>style="display: none;"<?}?>>
            <div class="form-group">
                <label for="" class="control-label col-sm-3">Content</label>
                <div class="col-sm-6">
                    <?
                    echo  yii\imperavi\Widget::widget([
                        'model' => $model,
                        'attribute' => 'description',
                        'plugins'=> ['fontsize','fontfamily','fontcolor','imagemanager', 'video', 'fullscreen', 'clips'],
                        'options' => [
                            'imageUpload'=> Yii::$app->urlManager->createUrl(['images/upload-image']),
                            'imageManagerJson'=>Yii::$app->urlManager->createUrl(['images/get-all-images-json']),
                            'imageUploadParam' =>'Products_image',
                            'minHeight'=> 400,
                            'uploadImageField'=>array(
                                Yii::$app->request->csrfParam => Yii::$app->request->csrfToken,
                            ),
                        ],
                    ]); 
                    ?>
                </div>

            </div>
        </div>

        <?php $this->endBlock(); ?>

        <?=
        \yii\bootstrap\Tabs::widget(
            [
                'encodeLabels' => false,
                'items' => [ [
                    'label'   => 'Sliders',
                    'content' => $this->blocks['main'],
                    'active'  => true,
                    ], ]
            ]
        );
        ?>

        <?if ($model->isNewRecord){?>
            <hr/>
            <h4>Slider Items</h4>
            <div class="callout callout-info">
                <h4>Instructions!</h4>
                <ol>
                    <li>Create slider first. Choose a slider type depending on how you want IT to look on the fronted. Once you choose the slider type and save you will not be able to change the slider type. [to modify the slider type]</li>
                    <li>Once the slider is created you will be redirected to the update page where you can add items to your slider.</li>
                </ol>


            </div>
            <?}else{?>
            <hr/>
            <h4>Slider Items</h4>
            <div class="callout callout-info">
                <h4>Instructions!</h4>
                <ol>
                    <li>Drag and drop to order items</li>
                </ol>


            </div>
            <a href="javascript:void(0);" class="btn  btn-success" type="button" id="add_item"><span class="glyphicon glyphicon-plus"></span> Add new item</a>

            <section id="new_item_content" style="display:none;">
                <hr />
                <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab_1" aria-expanded="true">Upload</a></li>
                    <li class=""><a data-toggle="tab" href="#tab_2" aria-expanded="false" id="choose">Choose</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab_1" class="tab-pane active">
                        <?
                        echo FileInput::widget([
                            'id'=>'Products_image',
                            'name'=>'Products_image',
                            'options' => [
                                'accept' => 'image/*',
                                'multiple'=>false,
                            ],
                            'pluginOptions' => [
                                'uploadUrl' => Url::to(['/images/upload-image']),
                                'overwriteInitial'=>true,
                                'showUpload'=>false,
                                'initialPreview'=>[]

                            ],
                            'pluginEvents' => [
                                "fileloaded" =>'function(event, data, previewId, index) { 
                                $("#Products_image").fileinput("upload");
                                }',
                                "fileuploaded" => 'function(event, data, previewId, index) { 
                                $("#choose").click();
                                $("#Products_image").fileinput("reset");
                                set_choose_items();
                                }',
                            ]                
                        ]);?>
                    </div><!-- /.tab-pane -->
                    <div id="tab_2" class="tab-pane">

                        <div id="tab_2_content">

                        </div>
                        <?if($model->type == 'slider_full_width_with_links'){?>
                        <?$sliderimg = new SliderImages;?>
                            <?= $form->field($sliderimg, 'link')->textInput() ?>
                        <?php } ?>
                        <?if($model->type == 'slider_thumb_caption'){?>
                            <hr />
                            <?$sliderimg = new SliderImages;?>
                            <?= $form->field($sliderimg, 'link')->textInput() ?>
                            <div class="form-group">
                                <label for="" class="control-label col-sm-3">Content</label>
                                <div class="col-sm-6">
                                    <?
                                    echo  yii\imperavi\Widget::widget([
                                        'model' => $sliderimg,
                                        'attribute' => 'content',
                                        'plugins'=> ['fontsize','fontfamily','fontcolor','imagemanager', 'video', 'fullscreen', 'clips'],
                                        'options' => [
                                            'imageUpload'=> Yii::$app->urlManager->createUrl(['images/upload-image']),
                                            'imageManagerJson'=>Yii::$app->urlManager->createUrl(['images/get-all-images-json']),
                                            'imageUploadParam' =>'Products_image',
                                            'minHeight'=> 400,
                                            'uploadImageField'=>array(
                                                Yii::$app->request->csrfParam => Yii::$app->request->csrfToken,
                                            ),
                                        ],
                                    ]); 
                                    ?>
                                </div>
                            </div>  
                            <?}?>

                        <hr />
                        <a href="javascript:void(0);" class="btn bg-maroon btn-flat" id="use_image" <?if($model->type == 'slider_tumb_caption'){?> onclick="get_other_data();" <?}else{?> onclick="generate_form();" <?}?> >Use this image</a>
                        <?=Html::HiddenInput('SliderImages[ImgID]', '', array('class'=>"image-file-id", 'id'=>'image_file'));  ?>
                    </div><!-- /.tab-pane -->
                </div>
            </section>


            <hr />

            <div class="table-responsive">

                <?
                /*Pjax::begin([
                'id'=>'slides-container',
                'enablePushState' => false,
                'timeout' => '6000',
                ]);*/

                $slider_images = new SliderImagesSearch;
                $slider_images->sliderID = $model->SliderID;
                if($model->type == 'slider_thumb_caption'){
                    $columns = [

                        //                        'SliderImagesID',
                        //                        'sliderID',
                        //                        'imageID',
                        'orderID',
                        [
                            'attribute'=>'imageID', 
                            //                            'vAlign'=>'bottom',
                            //                            'width'=>'190px',
                            'value'=>function ($model) { 
                                return "<img src='".Yii::getAlias('@script_url').'/resources/images/thumbnail/'.$model->image->file."' style='height:100px;' />";
                            },
                            'format'=>'raw'
                        ],

                        'link:url',
                        'content:html',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{delete}',
                            'buttons' => [

                                //view button
                                'delete' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-ban-circle"></span>Delete', $url, [
                                        'title' => Yii::t('app', 'Delete'),
                                        'class'=>'btn  btn-danger btn-xs', 
                                        'data-pjax'=>true,
                                        //                                        'data-confirm' => "Are you sure you want to delete this item?"                                  
                                    ]);
                                },
                            ],
                            'urlCreator' => function($action, $model, $key, $index) {
                                // using the column name as key, not mapping to 'id' like the standard generator
                                $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                                //                    $params .= '$data-pjax=true' ;
                                $params[0] =  'slider-images/' . $action;
                                return Url::toRoute($params);
                            },
                            'contentOptions' => ['nowrap'=>'nowrap']
                        ],
                    ];
                }else{
                    $columns = [

                        //                        'SliderImagesID',
                        //                        'sliderID',
                        //                        'imageID',
                        'orderID',
                        [
                            'attribute'=>'imageID', 
                            //                            'vAlign'=>'bottom',
                            //                            'width'=>'190px',
                            'value'=>function ($model) { 
                                return "<img src='".Yii::getAlias('@script_url').'/resources/images/thumbnail/'.$model->image->file."' style='height:100px;' />";
                            },
                            'format'=>'raw'
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{delete}',
                            'buttons' => [

                                //view button
                                'delete' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-ban-circle"></span>Delete', $url, [
                                        'title' => Yii::t('app', 'Delete'),
                                        'class'=>'btn btn-danger btn-xs', 
                                        'data-pjax'=>true,
                                        //                                        'data-confirm' => "Are you sure you want to delete this item?"                                  
                                    ]);
                                },
                            ],
                            'urlCreator' => function($action, $model, $key, $index) {
                                // using the column name as key, not mapping to 'id' like the standard generator
                                $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                                //                    $params .= '$data-pjax=true' ;
                                $params[0] =  'slider-images/' . $action;
                                return Url::toRoute($params);
                            },
                            'contentOptions' => ['nowrap'=>'nowrap']
                        ],
                        //                        'link',
                        //                        'content:ntext',
                    ];
                }    
                echo SortableGridView::widget([
                    'layout' => '{summary}{pager}{items}{pager}',
                    'dataProvider' => $slider_images->search($slider_images),
                    'pager'        => [
                        'class'          => yii\widgets\LinkPager::className(),
                        'firstPageLabel' => 'First',
                        'lastPageLabel'  => 'Last'        ],
                    'columns' => $columns,
                ]); 

                //                Pjax::end();    ?>
            </div>
            <?}?>       
        <hr/>

        <?= Html::submitButton('<span class="glyphicon glyphicon-check"></span> '.($model->isNewRecord ? 'Create' : 'Save'), ['class' => $model->isNewRecord ?  'btn btn-primary' : 'btn btn-primary']) ?>

        <?php ActiveForm::end(); ?>

    </div>

</div>
<!-- Modal form-->



<script type="text/javascript">
    $( document ).ready(function() {
        $("#sliders-type").change(function(){
            var slider_type = $(this).val();
            if(slider_type == 'slider_with_right_content'){
                $("#content_input").slideDown();
                $("#link_input").slideUp();
            }else if(slider_type == 'slider_video_full_width'){
                $("#content_input").slideDown();
                $("#link_input").slideDown();
            }else{
                $("#content_input").slideUp();
                $("#link_input").slideUp(); 
            }
        });

        $("#choose").click(function(){
            set_choose_items();
        })

        $("#add_item").click(function(){
            $("#new_item_content").slideDown();
        });
    });



    function set_choose_items(){
        $('#tab_2_content').html('');
        $.ajax({
            dataType: "json",
            cache: false,
            url: "<?=Yii::$app->urlManager->createUrl(['images/get-all-images-json'])?>",
            success: $.proxy(function(data)
                {
                    $('#tab_2_content').html('');
                    $.each(data, $.proxy(function(key, val)
                        {
                            var thumbtitle = '';
                            if (typeof val.title !== 'undefined') thumbtitle = val.title;
                            var img = $('<img src="' + val.thumb + '" rel="' + val.image + '" title="' + thumbtitle + '" style="width: 100px; height: 75px; cursor: pointer;" class="image_border" data-imgid="'+val.IMGID+'"/>');
                            $('#tab_2_content').append(img);
                            $(img).click(function(){
                                $(".image_border_selected").removeClass("image_border_selected");
                                $(this).addClass("image_border_selected");
                                $("#image_file").val(($(this).attr('data-imgid')));
                            });

                        }, this));
                }, this)
        });
    }

    function generate_form(){
        var data = $("#new_item_content :input").serialize();
        $.ajax({
            method: 'POST',
            data: data+"&SliderImages[SliderID]=<?=$model->SliderID?>",
            cache: false,
            url: "<?=Yii::$app->urlManager->createUrl(['slider-images/insert-image'])?>",
            success: $.proxy(function(data)
                {
                    if(data == true){
                        location.reload();
                    }else{
                        alert("error please try again later");
                    }                     
                }, this)
        });

    }

    function get_other_data(){
        $("#content_link").click(); 
    }




</script>
