<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\models\Categories $model
 */

$this->title = 'Categories Update ' . $model->name . '';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'CID' => $model->CID]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="categories-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view', 'CID' => $model->CID], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
