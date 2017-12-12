<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\models\Products $model
 */

$this->title = 'Products Update ' . $model->name . '';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'PID' => $model->PID]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="products-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view', 'PID' => $model->PID], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
