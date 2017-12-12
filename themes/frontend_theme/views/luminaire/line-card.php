<?php
frontend\assets\LineCardAsset::register($this);

use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;

use kartik\widgets\Select2;


?>
<div class="main-content line-card">
    <h1 class="line-card-title"><span>LINE CARD</span></h1>
    <?php 
    Pjax::begin([
        //    'id' => 'manuf_'.uniqid(),
        'enablePushState' => false,
        'timeout' => 2000,
        'formSelector' => '#line-card-form',
        'options' => [
            'class' => 'pajax-container',
        ]
    ]);
    ?>
    <div class="info">click to filter by cost range</div>
    <div class="scale-filter">
       
        <a href="javascript:void(0)" class="<?=(empty($model->cost_range) ? "selected" : "")?>" data-cost-range="all"><span>All</span></a>
        <span class="spacer"></span>
        <div class="group">
            <div class="arrow-left"></div>
            <div class="label left_abs_10px">Budget Grade</div>
            <ul>
                <li><a href="javascript:void(0)" class="<?=($model->cost_range == 1 ? "selected" : "")?>" data-cost-range="1"><small>Budget Grade</small></a></li>
                <li><a href="javascript:void(0)" class="<?=($model->cost_range == 2 ? "selected" : "")?>" data-cost-range="2"><small>Mid Grade</small></a></li>
                <li><a href="javascript:void(0)" class="<?=($model->cost_range == 3 ? "selected" : "")?>" data-cost-range="3"><small>Premium Grade</small></a></li>
                <li><a href="javascript:void(0)" class="<?=($model->cost_range == 4 ? "selected" : "")?>" data-cost-range="4"><small>Specification Grade</small></a></li>
            </ul>
            <div class="label right_abs_10px">Specification Grade</div>
            <div class="arrow-right"></div>
        </div>
        
    </div>

    <div class="search-form">
        <div class="field search-field">
<!--            <input type="text" name="q" placeholder="Search Manufactures">-->
            <?php 
            echo Select2::widget([
                
                'model' => $model, 
                'attribute' => 'name',
                'data' => array_merge(["" => ""], $model->getManufacturesForSelect($model->attributes)),
                'options' => [
                    'placeholder' => 'CLICK TO SEARCH MANUFACTURERS',
                    'class' => 'search-manufacture-input',
                ],
                
                'pluginOptions' => [
                    'allowClear' => false,
                    'hideSearch' =>false,
                ],
            ]);
            ?>
        </div>
        <input type="submit" name="submit" value="Search">
    </div>

    <?php 
    $form = ActiveForm::begin([
        'id'=>'line-card-form',
         'method' => 'GET',
         
        'options' => [
            'data-pjax'=>true,
           
        ],
        'layout' => 'horizontal', 
        'enableClientValidation' => false
    ]);
    echo $form->field($model, 'cost_range',['template'=>'{input}'])->hiddenInput(['class'=>'cost-range']);
//    echo $form->field($model, 'cost_range',['template'=>'{input}'])->textInput(['class'=>'cost-range']);

    ActiveForm::end();
    ?>

    <?=$this->render("_line-card-group-list",['dataProvider'=>$dataProvider,'model'=>$model,'params' => $params])?>

    <?php Pjax::end() ?>
</div>
