<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Import';
$this->params['breadcrumbs'][] = ['label' => 'Import', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Import';
?>

<div class="products-create">

    <p class="pull-left">
        <?= Html::a('Cancel', \yii\helpers\Url::previous(), ['class' => 'btn btn-default']) ?>
    </p>
    <div class="clearfix"></div>

    <?php echo $this->render('_form', [
    'model' => $model,
    'module' => $module,
    ]); ?>

</div>
