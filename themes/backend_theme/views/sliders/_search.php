<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\SlidersSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="sliders-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'SliderID') ?>

		<?= $form->field($model, 'name') ?>

		<?= $form->field($model, 'type') ?>

		<?= $form->field($model, 'video_button') ?>

		<?= $form->field($model, 'description') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
