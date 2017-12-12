<?php
frontend\assets\RateWebsiteAsset::register($this);

use yii\bootstrap\ActiveForm;
?>
<div class="main-content full-width">
    <div class="">
        <?php 
        if($page) {
            $page->parseContent();
            echo $page->content;
        } else {
            ?>
            <h1 class="page-title">Rate Our Website</h1>

            <p class="align-center">
                Welcome to Our new website and state of the art Luminaire selector. <br>
                Let us know what you think!
            </p>
            <?php
        }
        ?>

        <?php 
        $form = ActiveForm::begin([
            'id'=>'rating-form',
            'enableClientValidation' => false
        ]);
        ?>

        <div class="field rating-field">
            <label>
                Rate from 1-5:
                <small>(1 = Needs more improvment | 5 = Perfect Site)</small>
            </label>
            <?=
            $form->field($model, 'rating',['template'=>'{input}'])->radioList([
                1 => '1', 
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
            ]);
            ?>
        </div>

        <div class="field">
            <label>Comments:</label>
            <?php echo $form->field($model, 'comments',['template'=>'{input}'])->textArea(); ?>
        </div>
        
        <div class="field">
            <label>Name:</label>
            <?php echo $form->field($model, 'name',['template'=>'{input}'])->textInput(); ?>
        </div>

        <div class="field">
            <label>Company:</label>
            <?php echo $form->field($model, 'company',['template'=>'{input}'])->textInput(); ?>
        </div>

        <div class="field">
            <label>Phone Number:</label>
            <?php echo $form->field($model, 'phone',['template'=>'{input}'])->textInput(); ?>
        </div>

        <div class="field">
            <label>Email:</label>
            <?php echo $form->field($model, 'email',['template'=>'{input}'])->input('email'); ?>
        </div>
        
        <div class="response <?=(!$model->success ? 'error' : 'success')?>">
            <?php 
                if($model->success) {
                    echo 'Your feedback has been sent. Thank you!';
                } else {
                    echo $form->errorSummary($model);
                }
            ?>
        </div>

        <div class="field buttons">
            <input type="submit" name="submit" value="Send">
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>