<?php
frontend\assets\SignupLoginPageAsset::register($this);

use yii\bootstrap\ActiveForm;
?>
<div class="main-content">
    <div class="signup-page">
        <h1 class="page-title">Login</h1>
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
                        'enableClientValidation' => false
                    ]);
                    ?>
                    <div class="field">
                        <?php echo $form->field($login, 'email',['template'=>'{input}'])->input('email',['placeholder'=>'E-Mail Address:']); ?>
                    </div>
                    <div class="field">
                        <?php echo $form->field($login, 'password',['template'=>'{input}'])->passwordInput(['placeholder'=>'Password:']); ?>
                    </div>
                    <div class="errors">
                        <?php echo $form->errorSummary($login); ?>
                    </div>
                    <div class="field buttons">
                        <a href="<?=Yii::$app->UrlManager->createUrl("site/request-password-reset") ?>">Forgot Password?</a>
                        <input type="submit" name="submit" value="Login">
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            <div class="side">
                <div class="box">
                    <h3>New To WFLi?</h3>
                    <p>Creating an account will allow you to manage your wishlist and customize the email sent to your clients.</p>
                    <?php 
                    $form = ActiveForm::begin([
                        'id'=>'login-form',
                        'enableClientValidation' => false
                    ]);
                    ?>
                    <div class="field">
                        <?php echo $form->field($signup, 'first_name',['template'=>'{input}'])->textInput(['placeholder'=>'First Name:']); ?>
                    </div>
                    <div class="field">
                        <?php echo $form->field($signup, 'last_name',['template'=>'{input}'])->textInput(['placeholder'=>'Last Name:']); ?>
                    </div>
                    <div class="field">
                        <?php echo $form->field($signup, 'email',['template'=>'{input}'])->input('email',['placeholder'=>'E-Mail Address:']); ?>
                    </div>
                    <div class="field">
                        <?php echo $form->field($signup, 'phone',['template'=>'{input}'])->textInput(['placeholder'=>'Phone:']); ?>
                    </div>
                    <div class="field">
                        <?php echo $form->field($signup, 'company',['template'=>'{input}'])->textInput(['placeholder'=>'Company:']); ?>
                    </div>
                    <div class="field">
                        <?php echo $form->field($signup, 'company_website',['template'=>'{input}'])->textInput(['placeholder'=>'Company Website:']); ?>
                    </div>
                    <div class="field">
                        <?php echo $form->field($signup, 'password',['template'=>'{input}'])->passwordInput(['placeholder'=>'Password:']); ?>
                    </div>
                    <div class="field">
                        <?php echo $form->field($signup, 'password2',['template'=>'{input}'])->passwordInput(['placeholder'=>'Password Verify:']); ?>
                    </div>
                    <div class="errors">
                        <?php echo $form->errorSummary($signup); ?>
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