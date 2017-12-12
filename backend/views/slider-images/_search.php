<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\models\SliderImagesSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="slider-images-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'SliderImagesID') ?>

		<?= $form->field($model, 'sliderID') ?>

		<?= $form->field($model, 'imageID') ?>

		<?= $form->field($model, 'orderID') ?>

		<?= $form->field($model, 'link') ?>

		<?php // echo $form->field($model, 'content') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
