<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var backend\models\Specialized $model
*/

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Specializeds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specialized-create">

    <p class="pull-left">
        <?= Html::a('Cancel', \yii\helpers\Url::previous(), ['class' => 'btn btn-default']) ?>
    </p>
    <div class="clearfix"></div>

    <?php echo $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
