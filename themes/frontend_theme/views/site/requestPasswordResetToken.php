<?php
frontend\assets\AppAsset::register($this);

use yii\bootstrap\ActiveForm;
?>
<div class="main-content reset-password">
    <h1 class="page-title">Reset Password</h1>
    <div class="box-reset">
        <h3>Reset password</h3>
        <p>Please fill out your email. A link to reset password will be sent there.</p>
        <?php 
        $form = ActiveForm::begin([
            'id'=>'reset-form',
            'enableClientValidation' => true
        ]);
        ?>
        <div class="field">
            <?php echo $form->field($model, 'email',['template'=>'{input}'])->input('email',['placeholder'=>'E-Mail Address:']); ?>
        </div>
        <div class="field buttons">
            <input type="submit" name="submit" value="Reset Password">
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>