<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Sliders $model
 */

$this->title = 'Sliders Update ' . $model->name . '';
$this->params['breadcrumbs'][] = ['label' => 'Sliders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'SliderID' => $model->SliderID]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="sliders-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view', 'SliderID' => $model->SliderID], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
