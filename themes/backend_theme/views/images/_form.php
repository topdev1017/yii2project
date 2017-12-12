<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;
use kartik\widgets\FileInput;
use yii\helpers\Url;

/**
* @var yii\web\View $this
* @var app\models\Images $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="images-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]); ?>

    <div class="">
        <?php echo $form->errorSummary($model); ?>
        <?php $this->beginBlock('main'); ?>

        <p>
            <?= $form->field($model, 'type')->dropDownList([ 'image' => 'Image', 'video' => 'Video', ], ['prompt' => 'Please choose a type']) ?>
            
            <div class="form-group" id="image_upload" <?if($model->type == 'video'){?>style="display: none;"<?}?>>
            <label for="" class="control-label col-sm-3">Image:</label>
            <?=Html::HiddenInput('Images[file]', $model->file, array('class'=>"image-file-id", 'id'=>'image_file'));  ?>
            
            <div class="col-sm-4">
            <?
            echo FileInput::widget([
                'id'=>'Products_image',
                'name'=>'Products_image',
                'options' => [
                    'accept' => 'image/*',
                    'multiple'=>false,
                ],
                'pluginOptions' => [
                    'uploadUrl' => Url::to(['/images/upload-slider-image']),
                    'overwriteInitial'=>true,
                    'showUpload'=>false,
                    'initialPreview'=>[
                        Html::img(Yii::getAlias('@web').'/../../resources/images/'.$model->file, ['class'=>'file-preview-image', 'alt'=>$model->file, 'title'=>$model->file])
                    ]
                    
                ],
                'pluginEvents' => [
                "fileloaded" =>'function(event, data, previewId, index) { 
                        $("#Products_image").fileinput("upload");
                    }',
                "fileuploaded" => 'function(event, data, previewId, index) { 
                        $("#image_file").val(data.response.Products_image[0].name);
                    }',
                ]                
            ]);?>
            </div>
            </div>'
            <div id="embed_type" <?if($model->type == 'image'){?>style="display: none;"<?}?>>
                <?= $form->field($model, 'embed')->textarea(['rows' => 6]) ?>
            </div>
			
			<?= $form->field($model, 'caption')->textarea(['rows' => 6]) ?>
			
        </p>
        <?php $this->endBlock(); ?>
        
        <?=
    \yii\bootstrap\Tabs::widget(
                 [
                   'encodeLabels' => false,
                     'items' => [ [
    'label'   => 'Images',
    'content' => $this->blocks['main'],
    'active'  => true,
], ]
                 ]
    );
    ?>
        <hr/>

        <?= Html::submitButton('<span class="glyphicon glyphicon-check"></span> '.($model->isNewRecord ? 'Create' : 'Save'), ['class' => $model->isNewRecord ?
        'btn btn-primary' : 'btn btn-primary']) ?>

        <?php ActiveForm::end(); ?>

    </div>

</div>
<script type="text/javascript">
$( document ).ready(function() {
    $("#images-type").change(function(){
       if($(this).val() == 'image'){
           $("#embed_type").slideUp();
           $("#image_upload").slideDown();
       }else if($(this).val() == 'video'){
           $("#image_upload").slideUp();
           $("#embed_type").slideDown();            
       }
    });
});

</script>
