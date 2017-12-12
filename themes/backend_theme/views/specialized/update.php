<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\models\Specialized $model
 */

$this->title = 'Specialized Update ' . $model->name . '';
$this->params['breadcrumbs'][] = ['label' => 'Specializeds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'SpID' => $model->SpID]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="specialized-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view', 'SpID' => $model->SpID], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
