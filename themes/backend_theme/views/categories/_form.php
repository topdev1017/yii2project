<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
* @var yii\web\View $this
* @var backend\models\Categories $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="categories-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]); ?>

    <div class="">
        <?php echo $form->errorSummary($model); ?>
        <?php $this->beginBlock('main'); ?>

        <p>
            
			<?php //echo $form->field($model, 'parent_ID')->textInput(['readonly'=>true]) ?>
            <?php 
            echo $form->field($model, 'parent_ID')->dropDownList($model->getCategoriesForDropdown(), ['prompt' => 'Choose a Parent Category',  ]) ;
            ?>
			<?= $form->field($model, 'name')->textInput(['maxlength' => 250]) ?>
			<?= $form->field($model, 'slug')->textInput(['maxlength' => 250]) ?>
			<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'status')->checkBox(['template' =>'<label class="control-label col-sm-3">Status</label><div class="col-sm-6">{input}<label>&nbsp;&nbsp;&nbsp;{label}</label></div>{error}', 'label'=>"Active", 'uncheck' => '0', 'checked' => '1', 'class'=>"icheckbox_minimal-blue"]); ?>
			<div class="form-group">
                    <label for="" class="control-label col-sm-3">Created At: </label>
                    <label for="" class="control-label col-sm-3"><?=$model->created_at?></label>
                </div>
                <div class="form-group">
                    <label for="" class="control-label col-sm-3">Updated At: </label>
                    <label for="" class="control-label col-sm-3"><?=$model->updated_at?></label>
                </div>
        </p>
        <?php $this->endBlock(); ?>
        
        <?=
    \yii\bootstrap\Tabs::widget(
                 [
                   'encodeLabels' => false,
                     'items' => [ [
    'label'   => 'Categories',
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
