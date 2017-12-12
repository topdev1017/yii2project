<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Images $model
 */

$this->title = 'Images Update ' . $model->ImgID . '';
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->ImgID, 'url' => ['view', 'ImgID' => $model->ImgID]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="images-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view', 'ImgID' => $model->ImgID], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
