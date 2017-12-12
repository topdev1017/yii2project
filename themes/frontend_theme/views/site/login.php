<?php
frontend\assets\SignupLoginPageAsset::register($this);

use yii\bootstrap\ActiveForm;
?>
<div class="main-content">
    <div class="signup-page page-content">
        <h1><span>Login</span></h1>
        <div class="row">
            <div class="side">
                <div class="box">
                    <h3>Login</h3>
                    <p>
                        Fill out the form below to login to your account and manage your wishlist.
                    </p>
                    <?php 
                    $form = ActiveForm::begin([
                        'id'=>'login-form',
                        'enableClientValidation' => true
                    ]);
                    ?>
                    <div class="field">
                        <?php echo $form->field($model, 'email',['template'=>'{input}'])->input('email',['placeholder'=>'E-Mail Address:']); ?>
                    </div>
                    <div class="field">
                        <?php echo $form->field($model, 'password',['template'=>'{input}'])->passwordInput(['placeholder'=>'Password:']); ?>
                    </div>
                    <div class="errors">
                        <?php echo $form->errorSummary($model); ?>
                    </div>
                    <div class="field buttons">
                        <a href="#">Forgot Password?</a>
                        <input type="submit" name="submit" value="Login">
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            <div class="side">
                <div class="box">
                    <h3>New To Mlazgar Associates?</h3>
                    <p>Creating an account will allow you to manage your wishlist and customize the email sent to your clients.</p>
                    <?php 
                    $form2 = ActiveForm::begin([
                        'id'=>'login-form',
                        'enableClientValidation' => true
                    ]);
                    ?>
                    <div class="field">
                        <?php echo $form2->field($signup, 'first_name',['template'=>'{input}'])->textInput(['placeholder'=>'First Name:']); ?>
                    </div>
                    <div class="field">
                        <?php echo $form2->field($signup, 'last_name',['template'=>'{input}'])->textInput(['placeholder'=>'Last Name:']); ?>
                    </div>
                    <div class="field">
                        <?php echo $form2->field($signup, 'email',['template'=>'{input}'])->input('email',['placeholder'=>'E-Mail Address:']); ?>
                    </div>
                    <div class="field">
                        <?php echo $form2->field($signup, 'phone',['template'=>'{input}'])->textInput(['placeholder'=>'Phone:']); ?>
                    </div>
                    <div class="field">
                        <?php echo $form2->field($signup, 'company',['template'=>'{input}'])->textInput(['placeholder'=>'Company:']); ?>
                    </div>
                    <div class="field">
                        <?php echo $form2->field($signup, 'company_website',['template'=>'{input}'])->textInput(['placeholder'=>'Company Website:']); ?>
                    </div>
                    <div class="field">
                        <?php echo $form2->field($signup, 'password',['template'=>'{input}'])->passwordInput(['placeholder'=>'Password:']); ?>
                    </div>
                    <div class="field">
                        <?php echo $form2->field($signup, 'password2',['template'=>'{input}'])->passwordInput(['placeholder'=>'Password Verify:']); ?>
                    </div>
                    <div class="errors">
                        <?php echo $form2->errorSummary($signup); ?>
                    </div>
                    <div class="field buttons">
                        <input type="submit" name="submit" value="Sign Up">
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        
    </div>
</div>