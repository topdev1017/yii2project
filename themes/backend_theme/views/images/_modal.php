<?
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;
use kartik\widgets\FileInput;
use yii\helpers\Url;

?>

<div id="redactor-modal-body">
    <section id="redactor-modal-image-insert">
        <div id="redactor-modal-tabber">
            <a class="active" href="#" rel="tab1">Upload</a><a href="#" rel="tab2">Choose</a>
        </div>
        <div class="redactor-tab redactor-tab1" id="redactor-modal-image-droparea">
            <?
            echo FileInput::widget([
                'id'=>'Upload_image',
                'name'=>'Upload_image',
                'options' => [
                    'accept' => 'image/*',
                    'multiple'=>false,
                ],
                'pluginOptions' => [
                    'uploadUrl' => Url::to(['/images/upload-slider-image']),
                    'overwriteInitial'=>true,
                    'showUpload'=>false,
                    'initialPreview'=>[]
                    
                ],
                'pluginEvents' => [
                "fileloaded" =>'function(event, data, previewId, index) { 
                        $("#Upload_image").fileinput("upload");
                    }',
                "fileuploaded" => 'function(event, data, previewId, index) { 
                        $("#image_file").val(data.response.Upload_image[0].name);
                    }',
                ]                
            ]);?>
        </div>
        <div id="redactor-image-manager-box" style="overflow: auto; height: 300px; display: none;" class="redactor-tab redactor-tab2">
            <img src="http://localhost/ls/resources/images/thumbnail/1.jpg" rel="http://localhost/ls/resources/images/1.jpg" title="http://localhost/ls/resources/images/1.jpg" style="width: 100px; height: 75px; cursor: pointer;">
            <img src="http://localhost/ls/resources/images/thumbnail/vintage-658.jpg" rel="http://localhost/ls/resources/images/vintage-658.jpg" title="http://localhost/ls/resources/images/vintage-658.jpg" style="width: 100px; height: 75px; cursor: pointer;">
            <img src="http://localhost/ls/resources/images/thumbnail/vintage-778.jpg" rel="http://localhost/ls/resources/images/vintage-778.jpg" title="http://localhost/ls/resources/images/vintage-778.jpg" style="width: 100px; height: 75px; cursor: pointer;">
        </div>
    </section>
</div>
