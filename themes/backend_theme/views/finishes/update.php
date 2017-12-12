<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\models\Finishes $model
 */

$this->title = 'Finishes Update ' . $model->name . '';
$this->params['breadcrumbs'][] = ['label' => 'Finishes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'FID' => $model->FID]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="finishes-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view', 'FID' => $model->FID], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
