<?php
frontend\assets\PartnerAsset::register($this);

use yii\bootstrap\ActiveForm;
use kartik\widgets\DatePicker;
?>
<div class="main-content partner">
    <h1>Partner with WFLi</h1>
    <?php 
    $form = ActiveForm::begin([
        'id'=>'partner-form',
        'enableClientValidation' => false
    ]);
    ?>
        <p>The WFLi team is excited for your visit to our market on</p>
        <div class="row">
            <div class="side small">
                <?php 
                echo $form->field($model, 'from_date')->widget(DatePicker::classname(), [
                    'options' => [
                    ],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'dd-M-yyyy'
                    ]
                ]);
                
                ?>
            </div>
            <div class="side small">
                <?php 
                echo $form->field($model, 'to_date')->widget(DatePicker::classname(), [
                    'options' => [
                    ],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'dd-M-yyyy'
                    ]
                ]);
                ?>
            </div>
        </div>
        <p>

            We are requesting that our manufacturer partners plan on spending two full days with our team. The agenda would include product training session(s) (2 hour max) with our staff starting at 8 a.m. the first day, and scheduled sales calls for the remainder of your time with us. <br>
            <br>
            In an attempt to maximize our time together, we are requesting the following information:
        </p>
        <div class="columns">
            <div class="col">
                <div class="field">
                    <label>Full Name:</label>
                    <?php echo $form->field($model, 'full_name',['template'=>'{input}'])->textInput(); ?>
                </div>
                <div class="field">
                    <label>Company Name:</label>
                    <?php echo $form->field($model, 'company',['template'=>'{input}'])->textInput(); ?>
                </div>
                <div class="field">
                    <label>Phone Number:</label>
                    <?php echo $form->field($model, 'phone',['template'=>'{input}'])->textInput(); ?>
                </div>
                <div class="field">
                    <label>Email Address:</label>
                    <?php echo $form->field($model, 'email',['template'=>'{input}'])->textInput(); ?>
                </div>
                <div class="field">
                    <label>Flight Information:</label>
                    <h4>(Incoming and outgoing times and airline)</h4>
                    <?php echo $form->field($model, 'flight_info',['template'=>'{input}'])->textArea(); ?>
                </div>
                <div class="field">
                    <label>Hotel Information:</label>
                    <h4>(Name and address of hotel)</h4>
                    <?php echo $form->field($model, 'hotel_info',['template'=>'{input}'])->textArea(); ?>
                </div>
                
            </div>
            <div class="col">
                <div class="field">
                    <label>Rental Car Information:</label>
                    <h4>(Name of rental company and address)</h4>
                    <?php echo $form->field($model, 'rental_car_info',['template'=>'{input}'])->textArea(); ?>
                </div>
                <div class="field">
                    <label>Sales Plan/Target</label>
                    <h4>(Visit Focus/Product Information)</h4>
                    <?php echo $form->field($model, 'sales_plan',['template'=>'{input}'])->textArea(); ?>
                </div>
                <div class="field">
                    <br>
                    <label>Literature We Will Need:</label>
                    <?php echo $form->field($model, 'literature',['template'=>'{input}'])->textArea(); ?>
                </div>
                <div class="field">
                    <br>
                    <label>Samples you are bringing or having shipped:</label>
                    <?php echo $form->field($model, 'samples',['template'=>'{input}'])->textArea(); ?>
                </div>
            </div>
        </div>
        <div class="errors">
            <?php echo $form->errorSummary($model); ?>
        </div>
        <div class="bottom-submit">
            <div class="info">
                <p>We understand that schedules change and want our partners to know that the schedule will only be confirmed after receipt of the information requested. Our office will coordinate the sales, quotation, and design teams to attend your training, and we will have targeted accounts scheduled for your visit based on the information you provide. We look forward to your visit and please let us know if there are any special arrangements that you will need during your time here.</p>
                <p><b>Safe travels and we will see you soon!</b></p>
            </div>
            <div class="submit-area">
                <input type="submit" name="submit" value="Send">
            </div>
        </div>
    <?php ActiveForm::end() ?>
</div>