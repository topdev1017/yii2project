<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;

/**
* @var yii\web\View $this
* @var backend\models\SliderImages $model
* @var yii\widgets\ActiveForm $form
*/

?>

<div class="slider-images-form">

    <?php $form = ActiveForm::begin([
        'id'     => 'SliderImages',
        'layout' => 'horizontal',
        'enableClientValidation' => false,
        ]
    );
    ?>

    <div class="">
        <?php echo $form->errorSummary($model); ?>
        <?php $this->beginBlock('main'); ?>
        <p>
            <?= $form->field($model, 'sliderID')->textInput() ?>
            <?= $form->field($model, 'imageID')->textInput() ?>
            <?= $form->field($model, 'orderID')->textInput() ?>
        </p>
        <?php $this->endBlock(); ?>

        <?=
        Tabs::widget(
            [
                'encodeLabels' => false,
                'items' => [ [
                    'label'   => 'SliderImages',
                    'content' => $this->blocks['main'],
                    'active'  => true,
                    ], ]
            ]
        );
        ?>
        <hr/>

        <?= Html::submitButton(
            '<span class="glyphicon glyphicon-check"></span> ' . ($model->isNewRecord
                ? 'Create' : 'Save'),
            [
                'id'    => 'save-' . $model->formName(),
                'class' => 'btn btn-success'
            ]
        );
        ?>


        <?php ActiveForm::end(); ?>

    </div>

</div>
