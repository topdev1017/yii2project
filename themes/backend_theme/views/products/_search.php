<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\models\ProductsSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="products-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'PID') ?>

		<?= $form->field($model, 'name') ?>

		<?= $form->field($model, 'description') ?>

		<?= $form->field($model, 'manufacture_product_url') ?>

		<?= $form->field($model, 'slug') ?>

		<?php // echo $form->field($model, 'image') ?>

		<?php // echo $form->field($model, 'manufacture_id') ?>

		<?php // echo $form->field($model, 'status') ?>

		<?php // echo $form->field($model, 'created_at') ?>

		<?php // echo $form->field($model, 'updated_at') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
