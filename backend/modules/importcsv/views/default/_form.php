<?php

    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\bootstrap\ActiveForm;
    use kartik\sortinput\SortableInput;
    use kartik\widgets\Select2;
    use dosamigos\fileupload\FileUpload;
    use dosamigos\fileupload\FileUploadUI;

    /**
    * @var yii\web\View $this
    * @var backend\models\Products $model
    * @var yii\widgets\ActiveForm $form
    */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => true,'options'=>['enctype'=>'multipart/form-data']]); ?>

    <div class="clear">
        <?php echo $form->errorSummary($model); ?>
        <?php $this->beginBlock('main'); ?>
        <p>
            <?= $form->field($model, 'table')->widget(Select2::classname(), [
                'data' => $module->getTables(),
                'options' => ['placeholder' => 'Select table ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </p>
        <div style="padding-left:275px;">
            <?= FileUpload::widget([
                'model' => $model,
                'attribute' => 'file',
                'url' => ['default/upload'], // your url, this is just for demo purposes,
                'options' => ['accept' => 'image/*'],
                'clientOptions' => [
                    'maxFileSize' => 2000000
                ],
                // Also, you can specify jQuery-File-Upload events
                // see: https://github.com/blueimp/jQuery-File-Upload/wiki/Options#processing-callback-options
                'clientEvents' => [
                    'fileuploaddone' => 'function(e, data) {
                        $("#step2").show();
                    }',
                    'fileuploadfail' => 'function(e, data) {
                        console.log(e);
                        console.log(data);
                    }',
                ],
            ]);
            ?>

        </div>
        <?php $this->endBlock(); ?>
        <?php $this->beginBlock('step2'); ?>
        <h2>Step 2</h2>
        <p>Assign Table columns to excel columns</p>
        <?php $this->endBlock(); ?>
        <?php $this->beginBlock('step3'); ?>
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
                        'headerOptions' => ['id'=>'step2','style'=>'display:none']
                    ], 
                    [
                        'label'   => 'Import Step 3',
                        'content' => $this->blocks['step3'],
                        'active'  => false,
                        'headerOptions' => ['id'=>'step3','style'=>'display:none']
                    ], 
                ]
            ]
        );
        ?>
        <hr/>

        <?= Html::submitButton('<span class="glyphicon glyphicon-check"></span> Import', ['class' =>'btn btn-primary']) ?>

        <?php ActiveForm::end(); ?>

    </div>

</div>
