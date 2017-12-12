<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/**
* @var yii\web\View $this
* @var backend\models\Products $model
*/

$this->title = 'Products View ' . $model->name . '';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'PID' => $model->PID]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="products-view">

    <p class='pull-left'>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', ['update', 'PID' => $model->PID],
        ['class' => 'btn btn-info']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> New Products', ['create'], ['class' => 'btn
        btn-success']) ?>
    </p>

    <p class='pull-right'>
        <?= Html::a('<span class="glyphicon glyphicon-list"></span> List', ['index'], ['class'=>'btn btn-default']) ?>
    </p><div class='clearfix'></div> 

    
    <h3>
        <?= $model->name ?>    </h3>


    <?php $this->beginBlock('backend\models\Products'); ?>

    <?php echo DetailView::widget([
    'model' => $model,
    'attributes' => [
    			'PID',
			'name',
			'description:ntext',
			'manufacture_product_url:url',
			'slug',
			'image',
			'manufacture_id',
			'status',
			'created_at',
			'updated_at',
    ],
    ]); ?>

    <hr/>

    <?php echo Html::a('<span class="glyphicon glyphicon-trash"></span> Delete', ['delete', 'PID' => $model->PID],
    [
    'class' => 'btn btn-danger',
    'data-confirm' => Yii::t('app', 'Are you sure to delete this item?'),
    'data-method' => 'post',
    ]); ?>

    <?php $this->endBlock(); ?>


    
    <?=
    \yii\bootstrap\Tabs::widget(
                 [
                     'id' => 'relation-tabs',
                     'encodeLabels' => false,
                     'items' => [ [
    'label'   => '<span class="glyphicon glyphicon-asterisk"></span> Products',
    'content' => $this->blocks['backend\models\Products'],
    'active'  => true,
], ]
                 ]
    );
    ?></div>
