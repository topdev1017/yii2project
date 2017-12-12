<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;

/**
* @var yii\web\View $this
* @var app\models\Pages $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="pages-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal', 
        'enableClientValidation' => true, 
        'options' => ['enctype' => 'multipart/form-data'],
        'id' => 'pages-form'
        ]); ?>
    <div class="">
        <?php echo $form->errorSummary($model); ?>
        <?php $this->beginBlock('main'); ?>
            <?= $form->field($model, 'title')->textInput(['maxlength' => 250]) ?>
            
            <div class="form-group">
            <label for="" class="control-label col-sm-3">Content</label>
                <div class="col-sm-6">
            <?
              echo  yii\imperavi\Widget::widget([
                    'model' => $model,
                    'attribute' => 'content',
                    'plugins'=> ['fontsize','fontfamily','fontcolor','imagemanager', 'video', 'fullscreen', 'clips'],
                    'options' => [
                        'imageUpload'=> Yii::$app->urlManager->createUrl(['images/upload-image']),
                        'imageManagerJson'=>Yii::$app->urlManager->createUrl(['images/get-all-images-json']),
                        'imageUploadParam' =>'Products_image',
                        'minHeight'=> 400,
                        'paragraphize'=>false,
                        'replaceDivs'=>false,
                        'cleanSpaces'=>false,
                        'deniedTags'=>[],
                        'replaceTags'=>[],
                        'removeEmpty'=>[],
                        'uploadImageField'=>array(
                            Yii::$app->request->csrfParam => Yii::$app->request->csrfToken,
                        ),
                    ],
                ]); 
            ?>
            </div>
            </div>
            <?php if(!$model->isNewRecord && $model->slug == "luminaire/index") {
                
            } else {
                echo $form->field($model, 'slug')->textInput(['maxlength' => 250]);
            }
            ?>
        <?php $this->endBlock(); ?>
        
        <?=
    \yii\bootstrap\Tabs::widget(
                 [
                   'encodeLabels' => false,
                     'items' => [ [
    'label'   => 'Pages',
    'content' => $this->blocks['main'],
    'active'  => true,
], ]
                 ]
    );
    ?>
        <hr/>

        <?= Html::button('<span class="glyphicon glyphicon-check"></span> '.($model->isNewRecord ? 'Create' : 'Save'), [
        'class' => $model->isNewRecord ?
        'btn btn-primary pull-right' : 'btn btn-primary pull-right',
        'onClick' => '
            $("#pages-form").attr("action","'.($model->isNewRecord ? Yii::$app->UrlManager->createUrl("pages/create") : Yii::$app->UrlManager->createUrl(["pages/update",'PgID'=>$model->PgID])).'").removeAttr("target");
            $("#pages-form").submit();
        '
        ]) ?>
        
        <?= Html::button('<span class="glyphicon glyphicon-eye-open"></span> Preview Page', [
        'class' => 'btn btn-info pull-left',
        'name'=>'preview',
        'onClick' => '
            $("#pages-form").attr("action","'.($model->isNewRecord ? Yii::$app->UrlManager->createUrl("pages/preview") : Yii::$app->UrlManager->createUrl(["pages/preview","id"=>$model->PgID])).'").attr("target","_preview");
            $("#pages-form").submit();'
        ]) ?>

        <?php ActiveForm::end(); ?>
        <div class="clearfix"></div>
    </div>

</div>
