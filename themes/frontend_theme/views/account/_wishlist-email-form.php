<?php 
use backend\models\WishlistEmailForm;
use yii\bootstrap\ActiveForm;

$formModel = new WishlistEmailForm;
$form = ActiveForm::begin([
    'id'=>'wishlist-email-form',
    'enableClientValidation' => false
]);
?>
<?php echo $form->field($formModel, 'wishlist_id',['template'=>'{input}'])->hiddenInput(['value'=>$model['WID']]); ?>
<div class="thumbnail">
    <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/wishlist-page/custom-logo.jpg">
</div>
<div class="field">
    <?php echo $form->field($formModel, 'email',['template'=>'{input}'])->input('email',['placeholder'=>'Email Address']); ?>
</div>
<div class="field">
    <?php echo $form->field($formModel, 'subject',['template'=>'{input}'])->textInput(['placeholder'=>'Subject']); ?>
</div>
<div class="field">
    <?php echo $form->field($formModel, 'message',['template'=>'{input}'])->textArea(['placeholder'=>'Message/Notes']); ?>
</div>
<div class="field errors" style="display: none;text-align: center;"></div>
<div class="field buttons">
    <button class="submit-button">Send</button>
</div>
<?php 
ActiveForm::end();
?>
<script type="text/javascript">
$(document).ready(function() {
    $("#wishlist-email-form .submit-button").click(function(e) {
        e.preventDefault();
        var form = $("#wishlist-email-form");
        var data = form.serialize();
        form.find(".errors").hide();
        $.ajax({
            url: '<?=Yii::$app->UrlManager->createUrl("account/send-wishlist")?>',     
            type: 'POST',
            data: data,
            dataType: "json",
            success: function(response) {
                if(response.status == "OK") {
                    form.find("input, textarea").val("");
                } else {
                    $.each(response.message, function(i,v) {
                        var wrap = $("<p>").html(v[0]);
                        form.find(".errors").html(wrap).show();
                    })
                    
                }
            }
        });
    });
})
</script>