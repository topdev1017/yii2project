<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\models\Manufactures $model
 */

$this->title = 'Manufactures Update ' . $model->name . '';
$this->params['breadcrumbs'][] = ['label' => 'Manufactures', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'MID' => $model->MID]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="manufactures-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view', 'MID' => $model->MID], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
