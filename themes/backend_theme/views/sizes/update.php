<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\models\Sizes $model
 */

$this->title = 'Sizes Update ' . $model->name . '';
$this->params['breadcrumbs'][] = ['label' => 'Sizes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'SID' => $model->SID]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="sizes-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view', 'SID' => $model->SID], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
