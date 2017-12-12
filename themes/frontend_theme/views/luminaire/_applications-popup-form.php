<?php
frontend\assets\LineCardAsset::register($this);

use yii\bootstrap\ActiveForm;
?>
<a href="#" class="close-popup">X</a>
<div class="applications-popup-content">
    <h1>Have Questions?</h1>
    <p>
        Complete the fields below and we'll contact you as soon as possible. <br>
        Thank you!
    </p>
    <?php 
    $form = ActiveForm::begin([
        'id'=>'application-help-form',
        'enableClientValidation' => false
    ]);
    ?>
    <div class="row">
        <div class="side">
            <div class="field">
                <label>Full Name:</label>
                <?php echo $form->field($model, 'full_name',['template'=>'{input}'])->textInput(); ?>
            </div>
        </div>
        <div class="side">
            <label>Company:</label>
            <?php echo $form->field($model, 'company',['template'=>'{input}'])->textInput(); ?>
        </div>
    </div>
    
    <div class="row">
        <div class="side">
            <div class="field">
                <label>Email:</label>
                <?php echo $form->field($model, 'email',['template'=>'{input}'])->input('email'); ?>
            </div>
        </div>
        <div class="side">
            <label>Phone:</label>
            <?php echo $form->field($model, 'phone',['template'=>'{input}'])->textInput(); ?>
        </div>
    </div>
    <div class="field">
        <label>Comments/Questions:</label>
        <?php echo $form->field($model, 'comments',['template'=>'{input}'])->textArea(); ?>
    </div>
    <div class="errors" style="display: none;"></div>
    <?php ActiveForm::end() ?>
</div>

<div class="buttons">
    <div class="side">All Fields Required</div>
    <div class="side">
        <a href="#" class="submit">Submit</a>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $(".submit").click(function(e) {
        e.preventDefault;
        var form = $("#application-help-form");
        form.find(".errors, .success").hide().html("");
        form.find(".success").removeClass("success").addClass("errors").hide();
        $.ajax({
            url: '<?=Yii::$app->UrlManager->createUrl("luminaire/applications-help-popup")?>',                         
            type: 'POST',
            data: form.serialize(),
            dataType: "json",
            success: function(response) {
                if(response.status == "OK") {
                    //
                    form.find(".errors").removeClass("errors").addClass("success").html("Message Sent");
                    form.find("input, textarea").val("");
                } else {
                    $.each(response.message, function(i,v) {
                        var wrap = $("<p>").html(v[0]);
//                        form.find(".errors").append(wrap);
                        form.find(".errors").html(wrap);
                    })
                    form.find(".errors").show();
                }
            }
        })
    });
})
</script>