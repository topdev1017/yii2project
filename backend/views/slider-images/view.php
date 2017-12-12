<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;

/**
* @var yii\web\View $this
* @var backend\models\SliderImages $model
*/

$this->title = 'Slider Images ' . $model->SliderImagesID;
$this->params['breadcrumbs'][] = ['label' => 'Slider Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->SliderImagesID, 'url' => ['view', 'SliderImagesID' => $model->SliderImagesID]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="slider-images-view">

    <!-- menu buttons -->
    <p class='pull-left'>
        <?= Html::a('<span class="glyphicon glyphicon-list"></span> ' . 'List', ['index'], ['class'=>'btn btn-default']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> ' . 'Edit', ['update', 'SliderImagesID' => $model->SliderImagesID],['class' => 'btn btn-info']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' . 'New' . '
        Slider Images', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="clearfix"></div>

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <?= \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>


    
    <h3>
        <?= $model->SliderImagesID ?>    </h3>


    <?php $this->beginBlock('backend\models\SliderImages'); ?>

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
    			'SliderImagesID',
			'sliderID',
			'imageID',
			'orderID',
			'link',
			'content:ntext',
    ],
    ]); ?>

    <hr/>

    <?= Html::a('<span class="glyphicon glyphicon-trash"></span> ' . 'Delete', ['delete', 'SliderImagesID' => $model->SliderImagesID],
    [
    'class' => 'btn btn-danger',
    'data-confirm' => '' . 'Are you sure to delete this item?' . '',
    'data-method' => 'post',
    ]); ?>
    <?php $this->endBlock(); ?>


    
    <?= Tabs::widget(
                 [
                     'id' => 'relation-tabs',
                     'encodeLabels' => false,
                     'items' => [ [
    'label'   => '<span class="glyphicon glyphicon-asterisk"></span> SliderImages',
    'content' => $this->blocks['backend\models\SliderImages'],
    'active'  => true,
], ]
                 ]
    );
    ?></div>
