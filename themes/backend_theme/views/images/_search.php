<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\ImagesSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="images-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'ImgID') ?>

		<?= $form->field($model, 'file') ?>

		<?= $form->field($model, 'embed') ?>

		<?= $form->field($model, 'caption') ?>

		<?= $form->field($model, 'type') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
