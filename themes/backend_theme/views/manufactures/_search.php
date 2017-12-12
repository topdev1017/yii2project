<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\models\ManufacturesSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="manufactures-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'MID') ?>

		<?= $form->field($model, 'name') ?>

		<?= $form->field($model, 'url') ?>

		<?= $form->field($model, 'image') ?>

		<?= $form->field($model, 'cost_range') ?>

		<?php // echo $form->field($model, 'status') ?>

		<?php // echo $form->field($model, 'created_at') ?>

		<?php // echo $form->field($model, 'updated_at') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
