<?php 
use backend\models\User;
use backend\models\WishlistEmailForm;
use yii\bootstrap\ActiveForm;

use dosamigos\selectize\SelectizeTextInput;
use dosamigos\selectize\SelectizeEmailInput;

$formModel = new WishlistEmailForm;
$form = ActiveForm::begin([
    'id'=>'wishlist-email-form',
    'enableClientValidation' => false,
    'options' => [
//        'autocomplete' => ''
    ]
]);
?>

<?php echo $form->field($formModel, 'wishlist_id',['template'=>'{input}'])->hiddenInput(['value'=>$model['WID']]); ?>
<?php 
if(!Yii::$app->user->isGuest) {
    $user = User::findOne(Yii::$app->user->id);
    if($user) {
        if(is_file(Yii::getAlias('@app')."/../resources/custom_images/".$user->avatar)) {
        ?>
        <div class="thumbnail">
            <img src="<?=Yii::getAlias('@script_url')?>/resources/custom_images/<?=$user->avatar?>">
        </div>
        <?php
        }
    }
}
?>
<div class="field response error">Could not send email</div>
<div class="field">
    <?php 
//    echo $form->field($formModel, 'email',['template'=>'{input}'])->widget(SelectizeTextInput::className(),[
    echo $form->field($formModel, 'email',['template'=>'{input}'])->widget(SelectizeEmailInput::className(),[
        'value' => '',
        'options' => [
            'autocomplete' => ''
        ],
        'clientOptions' => [
            'plugins' => array(
//                'remove_button',
//                'restore_on_backspace',
            ),
            'placeholder' => 'Email Address',
            'delimiter'=> ' ',
            'persist'=> false,
            'create'=> 'function(input) {
                return {
                    value: input,
                    text: input
                }
            }',
            
        ]
    ]); ?>
</div>
<div class="field">
    <?php echo $form->field($formModel, 'subject',['template'=>'{input}'])->textInput(['placeholder'=>'Subject']); ?>
</div>
<div class="field">
    <?php echo $form->field($formModel, 'message',['template'=>'{input}'])->textArea(['placeholder'=>'Please include your name and contact information in the message / notes. Sender appears as WFLi.']); ?>
</div>

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
        var msg = form.find(".response");
        var transitionSpeed = 1000;
        var delay = 7000;
        var that= $(this);
        that.prop('disabled', true).css("opacity","0.7");
        msg.slideUp(transitionSpeed).removeClass("error").removeClass("success");
        $.ajax({
            url: '<?=Yii::$app->UrlManager->createUrl("account/send-wishlist")?>',     
            type: 'POST',
            data: data,
            dataType: "json",
            success: function(response) {
                if(response.status == "OK") {
                    $("html, body").animate({ scrollTop: (msg.parent().offset().top - 95) }, 300);
                    msg.html(response.message).removeClass("error").addClass("success").slideDown(transitionSpeed).delay(delay).slideUp(transitionSpeed);
                    form.find('input:not(input[type="email"]), textarea').val("");
                    
                } else {
                    $("html, body").animate({ scrollTop: (msg.parent().offset().top - 95) }, 300);
                    msg.html(response.message).removeClass("success").addClass("error").slideDown(transitionSpeed).delay(delay).slideUp(transitionSpeed);  
                }
                that.prop('disabled', false).css("opacity","1");;
            },
            error: function(response) {
                msg.html('Could not send email').removeClass("success").addClass("error").slideDown(transitionSpeed).delay(delay).slideUp(transitionSpeed);
            }
        });
    });
})
</script>