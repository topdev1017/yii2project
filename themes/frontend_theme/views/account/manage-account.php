<?php

frontend\assets\ManageAccountAsset::register($this);

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\PasswordInput;
use yii\helpers\Url;

use kartik\widgets\FileInput;
use backend\models\User;

?>
<div class="main-content">
    <?=$this->render("//general_partial/_sidebar")?>
    <div class="manage-account-content page-content">
        <section class="section-header">
            <div class="breadcrumbs">
                <ul>
                    <li>WFLi</li>
                    <li>Username</li>
                    <li>Manage Account</li>
                </ul>
            </div>
            <h1>Manage Account</h1>
        </section>
        <?php 
        $form = ActiveForm::begin([
            'id'=>'manage-account-form',
            'enableClientValidation' => false
        ]);
        ?>
        <h3>Your Information</h3>
        <div class="section">
            <div class="row">
                <div class="side">
                    <div class="field">
                        <?= $form->field($model, 'first_name') ?>
                    </div>
                </div>
                <div class="side">
                    <div class="field">
                        <?= $form->field($model, 'last_name') ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="side">
                    <div class="field">
                        <?= $form->field($model, 'email')->input('email') ?>
                    </div>
                </div>
                <div class="side">
                    <div class="field">
                        <?= $form->field($model, 'phone') ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="side">
                    <div class="field">
                        <?= $form->field($model, 'company') ?>
                    </div>
                </div>
                <div class="side">
                    <div class="field">
                        <?= $form->field($model, 'company_website') ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="side">
                    <div class="field">
                        <label>Change Password:</label>
                        <?= $form->field($model, 'password',['template'=>"{input}"])->passwordInput() ?>
                        <? /*echo PasswordInput::widget([
                        'name' => 'password',
                        'pluginOptions' => [
                        'verdictTitles' => [
                        0 => 'Not Set',
                        1 => 'Very Poor',
                        2 => 'Poor',
                        3 => 'Fair',
                        4 => 'Good',
                        5 => 'Excellent'
                        ],
                        'verdictClasses' => [
                        0 => 'text-muted',
                        1 => 'text-danger',
                        2 => 'text-warning',
                        3 => 'text-info',
                        4 => 'text-primary',
                        5 => 'text-success'
                        ],
                        ]
                        ]);*/?>
                        <!--                        <input type="password">-->
                        <!--<div class="password-strength">
                        <div class="title">
                        Password Strength: 
                        <span class="weak">Too Short</span>
                        <span class="medium">Medium</span>
                        <span class="strong">Strong</span>
                        </div>
                        <div class="strength strength_2">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        </div>
                        </div>-->
                    </div>
                </div>
                <div class="side">
                    <div class="field">
                        <label>Verify Password:</label>
                        <?= $form->field($model, 'password2',['template'=>"{input}"])->passwordInput() ?>
                        <!--                        <input type="password">-->
                        <!--<div class="password-strength">
                        <div class="title">
                        Password Strength: 
                        <span class="weak">Too Short</span>
                        <span class="medium">Medium</span>
                        <span class="strong">Strong</span>
                        </div>
                        <div class="strength strength_1">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        </div>
                        </div>-->
                    </div>
                </div>
            </div>
            <div class="field errors">
                <?php echo $form->errorSummary($model); ?>
            </div>
            <div class="field buttons">
                <input type="submit" class="submit-btn" value="Update">
            </div>
        </div>
        <?php ActiveForm::end() ?>
        <h3>Company Logo</h3>
        <div class="section">
            <div class="current-logo">
                <?php 
                $src = Yii::$app->view->theme->baseUrl."/resources/images/manage-account/manage-account-default-company-logo.jpg";
                if(!Yii::$app->user->isGuest) {
                    $user = User::findOne(Yii::$app->user->id);
                    if($user) {
                        $src = Url::base(true)."/resources/custom_images/".$user->avatar;
                    }
                    
                } 
                ?>
                <img src="<?=$src?>">
            </div>
            <div class="logo-info ">
                <p>
                    Below is a preview of the logo you currently have set for your company. <br>
                    To update, click the "Browse" or "Choose File" button below. <br>
                    Supported formats are: .JPG, .PNG, and .GIF
                </p>
                <div class="buttons">
                    <?=Html::HiddenInput('SignupForm[file]', $model->custom_image, array('class'=>"custom-image-input", 'id'=>'custom_image_input'));  ?>
                    <div class="field">
                        <?php 
                        echo FileInput::widget([
                            'id' => 'custom_image_widget',
                            'name' => 'custom_image',
                            'options' => [
                                'accept' => 'image/*',
                                'multiple'=>false,
                            ],
                            'pluginEvents' => [
                                "fileloaded" =>'function(event, data, previewId, index) { 
                                    $("#custom_image_input").val(data.name);
                                    $("#custom_image_widget").fileinput("upload");
                                }',
                                "fileuploaded" => 'function(event, data, previewId, index) { 
                                    $(".current-logo img").attr("src",data.response.custom_image[0].mediumUrl);
                                    $(".upload-field").show();
                                }',
                            ],
                            'pluginOptions' => [
                                'uploadUrl' => Url::to(['account/upload']),
                                'overwriteInitial'=>false,
                                'showPreview' => true,
                                'showCaption' => true,
                                'showUpload' => false,
                                'showCancel' => false,
                                'showRemove' => false,
                                'initialCaption'=>"No files selected",
                                'submitClass' => 'upload-btn',
                                'browseClass' => 'browse-btn',
                                'cancelClass' => 'cancel-btn',
                                
                            ]
                        ]);
                        ?>
                    </div>
                    <div class="field upload-field" style="display: none;">
                        <a href="#" class="upload-btn">UPLOAD</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(e) {
   $(".upload-btn").on("click",function(e) {
       e.preventDefault();
       var data = {
           file: $("#custom_image_input").val()
       };
       $.ajax({
            url: '<?=Yii::$app->UrlManager->createUrl("account/set-custom-image")?>',     
            type: 'POST',
            data: data,
            dataType: "json",
            success: function(response) {
                if(response.status == "OK") {
                    $("#custom_image_widget").fileinput("reset");
                    $(".upload-field").hide();
                } 
            }
        })
   });
});
</script>