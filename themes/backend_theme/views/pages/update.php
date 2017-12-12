<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Pages $model
 */

$this->title = 'Pages Update ' . $model->title . '';
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->title, 'url' => ['view', 'PgID' => $model->PgID]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="pages-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view', 'PgID' => $model->PgID], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
