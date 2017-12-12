<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/**
* @var yii\web\View $this
* @var app\models\Images $model
*/

$this->title = 'Images View ' . $model->ImgID . '';
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->ImgID, 'url' => ['view', 'ImgID' => $model->ImgID]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="images-view">

    <p class='pull-left'>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', ['update', 'ImgID' => $model->ImgID],
        ['class' => 'btn btn-info']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> New Images', ['create'], ['class' => 'btn
        btn-success']) ?>
    </p>

        <p class='pull-right'>
        <?= Html::a('<span class="glyphicon glyphicon-list"></span> List', ['index'], ['class'=>'btn btn-default']) ?>
    </p><div class='clearfix'></div> 

    
    <h3>
        <?= $model->ImgID ?>    </h3>


    <?php $this->beginBlock('app\models\Images'); ?>

    <?php echo DetailView::widget([
    'model' => $model,
    'attributes' => [
    			'ImgID',
			'file',
			'embed:ntext',
			'caption:ntext',
			'type',
    ],
    ]); ?>

    <hr/>

    <?php echo Html::a('<span class="glyphicon glyphicon-trash"></span> Delete', ['delete', 'ImgID' => $model->ImgID],
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
    'label'   => '<span class="glyphicon glyphicon-asterisk"></span> Images',
    'content' => $this->blocks['app\models\Images'],
    'active'  => true,
], ]
                 ]
    );
    ?></div>
