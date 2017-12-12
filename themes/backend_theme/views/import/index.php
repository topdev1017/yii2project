<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\helpers\ArrayHelper;
    use yii\bootstrap\ActiveForm;
    use kartik\sortinput\SortableInput;
    use kartik\widgets\Select2;
    use kartik\widgets\FileInput;
$this->title = 'Import';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(['id'=>'import_form','layout' => 'horizontal', 'enableClientValidation' => true,'options'=>['enctype'=>'multipart/form-data']]); ?>
    <div class="clear">
        <?php $this->beginBlock('main'); ?>
        <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Upload File</h3>
        </div><!-- /.box-header -->
        <div class="form-group"> &nbsp;</div>
        <div class="form-group">
            <?= $form->field($model, 'table')->widget(Select2::classname(), [
                'data' => $model->getTables(),
                'options' => ['placeholder' => 'Select table ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
        <div class="form-group">
        <label for="" class="control-label col-sm-3">File:</label>
            <div class="col-sm-4">
            <?=Html::HiddenInput('ImportCsv[file]', $model->file, array('class'=>"products-image-id", 'id'=>'prod_image'));  ?>
           <? echo FileInput::widget([
                'id'=>'Products_image',
                'name'=>'Products_image',
                'options' => [
                    'accept' => 'excel/*',
                    'multiple'=>false,
//                    'id'=>'Products_image',
//                    'name'=>'Manufacture[image]'
                ],
                'pluginOptions' => [
                    'uploadUrl' => Url::to(['/import/upload-file']),
                    //'initialPreview'=>[
//                        Html::img(Yii::getAlias('@web')."/../../resources/products/".$model->image, ['class'=>'file-preview-image', 'alt'=>$model->name, 'title'=>$model->name])
//                    ],
                    'overwriteInitial'=>true,
                    'showUpload'=>false
                    
                ],
                'pluginEvents' => [
                "fileloaded" =>'function(event, data, previewId, index) { 
                        $("#Products_image").fileinput("upload");
                    }',
                "fileuploaded" => 'function(event, data, previewId, index) { 
                        $("#prod_image").val(data.response.Products_image[0].name);
                    }',
                ]                
            ]);?>
            </div>
        </div>
            <div class="box-footer">
                        <?echo Html::button('<span class="glyphicon glyphicon-check"></span> Import', [ 'class' => 'btn btn-primary', 'id'=> 'import_step1' ]);?>
            </div>
        </div>
        
        <?php $this->endBlock(); ?>
        <?php $this->beginBlock('step2'); ?>
        <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Please wait while the import is loading your data!</h3>
            </div><!-- /.box-header -->
        </div>
        <?php $this->endBlock(); ?>
        <?php $this->beginBlock('step3'); ?>
        <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Please wait while the import is loading your data!</h3>
            </div><!-- /.box-header -->
        </div>
        <?php $this->endBlock(); ?>
        <?=
        \yii\bootstrap\Tabs::widget(
            [
                'encodeLabels' => false,
                'items' => [ 
                    [
                        'label'   => 'Import',
                        'content' => $this->blocks['main'],
                        'active'  => true,
                        'headerOptions' => ['id'=>'step1']
                    ], 
                    [
                        'label'   => 'Import Step 2',
                        'content' => $this->blocks['step2'],
                        'active'  => false,
                        'headerOptions' => ['id'=>'step2']
                    ], 
                    [
                        'label'   => 'Import Step 3',
                        'content' => $this->blocks['step3'],
                        'active'  => false,
                        'headerOptions' => ['id'=>'step3']
                    ], 
                ]
            ]
        );
        ?>
        

        <?php ActiveForm::end(); ?>

    </div>

</div>
<script type="text/javascript">
$(document).ready(function() {
 $("#import_step1").click(function(){
     data = $("#import_form").serialize(); 
     console.log(data);
     $.ajax({
        type: 'POST',
        url: '<?=Yii::$app->UrlManager->CreateUrl('import/read-import-file')?>',
        data: data,
        success: function(data){
//            console.log(data);
            $("#step2 a").click();
            $("#w0-tab1").html(data);
            //results = $.parseJSON(data);
//            if(results.status == 'success'){
//                
//            }else{
//                $.errorHandler().setError('Error:',results.errors);
//            }
        }
     });
 });
});

</script>
