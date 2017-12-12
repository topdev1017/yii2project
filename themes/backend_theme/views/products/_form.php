<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use kartik\sortinput\SortableInput;
use kartik\widgets\Select2;
use kartik\checkbox\CheckboxX;
use dosamigos\selectize\Selectize;
use yii\web\JsExpression;
use kartik\widgets\FileInput;

use backend\models\Categories;
use backend\models\Manufactures;
use backend\models\Sizes;
use backend\models\Tags;
use backend\models\Finishes;

/**
* @var yii\web\View $this
* @var backend\models\Products $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => true, 'options' => ['enctype' => 'multipart/form-data'],]); ?>

    <div class="">
        <?php echo $form->errorSummary($model); ?>
        <?php $this->beginBlock('main'); ?>

            <? //$form->field($model, 'PID')->textInput(['readonly'=>true]) ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => 250]) ?>
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'manufacture_product_url')->textInput(['maxlength' => 300]) ?>
            <?= $form->field($model, 'no_iframe')->checkbox(['uncheck'=>'0','value'=>'1']) ?>
            <?= $form->field($model, 'slug')->textInput(['maxlength' => 150]) ?>
            <?=Html::HiddenInput('Products[image]', $model->image, array('class'=>"products-image-id", 'id'=>'prod_image'));  ?>
             <div class="form-group">
            <label for="" class="control-label col-sm-3">Image:</label>
            <div class="col-sm-4">
            <? echo FileInput::widget([
                'id'=>'Products_image',
                'name'=>'Products_image',
                'options' => [
                    'accept' => 'image/*',
                    'multiple'=>false,
//                    'id'=>'Products_image',
//                    'name'=>'Manufacture[image]'
                ],
                'pluginOptions' => [
                    'uploadUrl' => Url::to(['/products/upload-image']),
                    'initialPreview'=>[
                        Html::img(Yii::getAlias('@web')."/../../resources/products/".$model->image, ['class'=>'file-preview-image', 'alt'=>$model->name, 'title'=>$model->name])
                    ],
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
            </div></div>
            <?= $form->field($model, 'manufacture_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Manufactures::find()->all(),'MID','name'),
                'options' => ['placeholder' => 'Select a manufacture ...'],
                'pluginOptions' => [
                    'allowClear' => true
                    ],
                ]); ?>
            <?= $form->field($model, 'cost_range')->widget(Select2::classname(), [
                'data' => $model->getCostRangeArray(),
                'options' => ['placeholder' => 'Select a cost range ...'],
                'pluginOptions' => [
                    'allowClear' => true
                    ],
                ]); ?>
            
            <div class="form-group">
            <label for="" class="control-label col-sm-3">Categories</label>
                <div class="col-sm-3" style="max-height:300px;overflow:auto;">
                <p class="text-center">
                    <strong>Assigned Categories</strong>
                  </p>
                
                <?
                $prod_categories = $model->category;
                $prod_items = [];
                $prod_it = [];
                foreach($prod_categories as $cat){
                   array_push($prod_it, $cat->CID); 
                   $prod_items[$cat->CID] = ['content' => $cat->name];
                }
                
                $categories = ArrayHelper::map(Categories::find()->orderBy('name')->asArray()->all(), 'CID', 'name');
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
                
                <div class="col-sm-3" style="max-height:300px;overflow:auto;">
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
            <label for="" class="control-label col-sm-3">Sizes</label>
                <div class="col-sm-3" style="max-height:300px;overflow:auto;">
                <p class="text-center">
                    <strong>Assigned Sizes</strong>
                  </p>
                <?
                $prod_categories = $model->size;
                $prod_items = [];
                $prod_it = [];
                foreach($prod_categories as $cat){
                   array_push($prod_it, $cat->SID); 
                   $prod_items[$cat->SID] = ['content' => $cat->name];
                }
                
                $categories = ArrayHelper::map(Sizes::find()->orderBy('name')->asArray()->all(), 'SID', 'name');
                $items = [];
                foreach($categories as $key => $name){
                   if(!in_array($key, $prod_it)){
                      $items[$key] = ['content' => $name]; 
                   } 
                   
                }
                
                echo SortableInput::widget([
                'name'=>'sizes-1',
                'id'=>'sizes-1',
                'items' => $prod_items,
                'hideInput' => false,
                'sortableOptions' => [
                    'connected'=>'sizes-1',
                ],
                'options' => ['class'=>'form-control', 'readonly'=>true]
                ]);
                ?>
                </div> 
                <div class="col-sm-3" style="max-height:300px;overflow:auto;">
                <p class="text-center">
                        <strong>Sizes Bank</strong>
                      </p>
                <?
                
                echo SortableInput::widget([
                'name'=>'sizes-2',
                'id'=>'sizes-2',
                'items' => $items,
                'hideInput' => false,
                'sortableOptions' => [
                    'connected'=>'sizes-1',
                ],
                'options' => ['class'=>'form-control', 'readonly'=>true]
                ]);
                ?>    
                </div>
            </div>
            <div class="form-group">
            <label for="" class="control-label col-sm-3">Finishes</label>
                <div class="col-sm-3" style="max-height:300px;overflow:auto;">
                <p class="text-center">
                        <strong>Assigned Finishes</strong>
                      </p>
                <?
                $prod_categories = $model->finish;
                $prod_items = [];
                $prod_it = [];
                foreach($prod_categories as $cat){
                   array_push($prod_it, $cat->FID); 
                   $prod_items[$cat->FID] = ['content' => $cat->name];
                }
                
                $categories = ArrayHelper::map(Finishes::find()->orderBy('name')->asArray()->all(), 'FID', 'name');
                $items = [];
                foreach($categories as $key => $name){
                   if(!in_array($key, $prod_it)){
                      $items[$key] = ['content' => $name]; 
                   } 
                   
                }
                
                echo SortableInput::widget([
                'name'=>'finish-1',
                'id'=>'finish-1',
                'items' => $prod_items,
                'hideInput' => false,
                'sortableOptions' => [
                    'connected'=>'finish-1',
                ],
                'options' => ['class'=>'form-control', 'readonly'=>true]
                ]);
                ?>
                </div> 
                <div class="col-sm-3" style="max-height:300px;overflow:auto;">
                <p class="text-center">
                    <strong>Finishes Bank</strong>
                </p>
                <?
                
                echo SortableInput::widget([
                'name'=>'finish-2',
                'id'=>'finish-2',
                'items' => $items,
                'hideInput' => false,
                'sortableOptions' => [
                    'connected'=>'finish-1',
                ],
                'options' => ['class'=>'form-control', 'readonly'=>true]
                ]);
                ?>    
                </div>
            </div>
            <div class="clear"></div>
           <!-- <div class="form-group">
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
            </div> -->       
            <?= $form->field($model, 'status')->checkBox(['template' =>'<label class="control-label col-sm-3">Status</label><div class="col-sm-6">{input}<label>&nbsp;&nbsp;&nbsp;{label}</label></div>{error}', 'label'=>"Active", 'uncheck' => '0', 'checked' => '1', 'class'=>"icheckbox_minimal-blue"]); ?>
                <div class="form-group">
                    <label for="" class="control-label col-sm-3">Created At: </label>
                    <label for="" class="control-label col-sm-3"><?=$model->created_at?></label>
                </div>
                <div class="form-group">
                    <label for="" class="control-label col-sm-3">Updated At: </label>
                    <label for="" class="control-label col-sm-3"><?=$model->updated_at?></label>
                </div>
            
        <?php $this->endBlock(); ?>
        
        <?=
    \yii\bootstrap\Tabs::widget(
                 [
                   'encodeLabels' => false,
                     'items' => [ [
    'label'   => 'Products',
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