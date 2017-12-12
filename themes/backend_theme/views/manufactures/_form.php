<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\sortinput\Sortable;
use kartik\sortinput\SortableInput;
use kartik\widgets\Select2;
use kartik\checkbox\CheckboxX;
use dosamigos\selectize\Selectize;
use yii\web\JsExpression;
use kartik\widgets\FileInput;

use backend\models\Specialized;
use backend\models\ManufactureSpecialized;

/**
* @var yii\web\View $this
* @var backend\models\Manufactures $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="manufactures-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false, 'options' => ['enctype' => 'multipart/form-data'],]); ?>

    <div class="">
        <?php echo $form->errorSummary($model); ?>
        <?php $this->beginBlock('main'); ?>
        <p>
            <?= $form->field($model, 'MID')->textInput(['readonly'=>true]) ?>
			<?= $form->field($model, 'name')->textInput(['maxlength' => 250]) ?>
            <?= $form->field($model, 'url')->textInput(['maxlength' => 300]) ?>
            <?= $form->field($model, 'no_iframe')->checkbox(['uncheck'=>'0','value'=>'1']) ?>
			<?=Html::HiddenInput('Manufactures[image]', $model->image, array('class'=>"products-image-id", 'id'=>'man_image'));  ?>
             <div class="form-group">
            <label for="" class="control-label col-sm-3">Image:</label>
            <div class="col-sm-4">
            <? echo FileInput::widget([
                'id'=>'Manufacture_image',
                'name'=>'Manufacture_image',
                'options' => [
                    'accept' => 'image/*',
                    'multiple'=>false,
//                    'id'=>'Manufacture_image',
//                    'name'=>'Manufacture[image]'
                ],
                'pluginOptions' => [
                    'uploadUrl' => Url::to(['/manufactures/upload-image']),
                    'initialPreview'=>[
                        Html::img(Yii::getAlias('@web')."/../../resources/manufactures/".$model->image, ['class'=>'file-preview-image', 'alt'=>$model->name, 'title'=>$model->name])
                    ],
                    'overwriteInitial'=>true,
                    
                ],
                'pluginEvents' => [
                "fileloaded" =>'function(event, data, previewId, index) { 
                        $("#Manufacture_image").fileinput("upload");
                    }',
                "fileuploaded" => 'function(event, data, previewId, index) { 
                        $("#man_image").val(data.response.Manufacture_image[0].name);
                    }',
                ]                
            ]);?>
            </div></div>
            <?= $form->field($model, 'cost_range')->widget(Select2::classname(), [
            'data' => $model->getCostRangeArray(),
            'options' => ['placeholder' => 'Select a cost range ...'],
            'pluginOptions' => [
                'allowClear' => true
                ],
            ]); ?>
            
            <div class="form-group">
            <label for="" class="control-label col-sm-3">Specialized Categories</label>
                <div class="col-sm-3">
                <p class="text-center">
                    <strong>Assigned Categories</strong>
                  </p>
                
                <?
                $prod_categories = $model->specialized;
                $prod_items = [];
                $prod_it = [];
                foreach($prod_categories as $cat){
                   array_push($prod_it, $cat->SpID); 
                   $prod_items[$cat->SpID] = ['content' => $cat->name];
                }
                
                $categories = ArrayHelper::map(Specialized::find()->orderBy('name')->asArray()->all(), 'SpID', 'name');
                $items = [];
                foreach($categories as $key => $name){
                   if(!in_array($key, $prod_it)){
                      $items[$key] = ['content' => $name]; 
                   } 
                   
                }
                
                echo SortableInput::widget([
                'name'=>'cat-1',
                'id'=>'cat-1',
                'items' => $prod_items,
                'hideInput' => false,
                'sortableOptions' => [
                    'connected'=>'cat-2',
                ],
                'options' => ['class'=>'form-control', 'readonly'=>true]
                ]);
                ?>
                </div> 
                
                <div class="col-sm-3">
                <p class="text-center">
                        <strong>Category Bank</strong>
                      </p>
                <?
                
                echo SortableInput::widget([
                'name'=>'cat-2',
                'id'=>'cat-2',
                'items' => $items,
                'hideInput' => false,
                'sortableOptions' => [
                    'connected'=>'cat-2',
                ],
                'options' => ['class'=>'form-control', 'readonly'=>true]
                ]);
                ?>    
                </div>
            </div>
            <div class="form-group">
            <label for="" class="control-label col-sm-3">Keywords</label>
            <div class="col-sm-6">
             <?              
             echo Selectize::widget([
                        'name' => 'Tags',
                        'id' => 'Tags',
                        'value' => $model->getTagNames(),
//                        'url' => ['tags/list'],
                        'options'=>[
                            'class' => 'yii-selectize style-1',
//                            'hint' => 'Enter Search Terms For Your Video...',
//                            'maxItems' => 5,
//                            'id'=>'VideosArea_tags',
                            'placeholder' => 'Add tags here:'
                        ],
                        'clientOptions' => [
                            'delimiter' => ',',
                            'plugins' => ['remove_button'],
                            'persist' => false,
                            'create' => new JsExpression("function(input) { return { value: input, text: input }; }"),
                        ],
                    ]) ?> 
            </div>        
            </div>
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
    'label'   => 'Manufactures',
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
