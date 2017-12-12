<?
use kartik\widgets\Select2;
 use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\helpers\ArrayHelper;
    use yii\bootstrap\ActiveForm;
?>
<div id="columns_form">
<div class="box box-primary">
<div class="box-header">
  <h3 class="box-title">Products</h3>
</div><!-- /.box-header -->
<?
   foreach($tmodel->attributeLabels() as $key => $att){
       if($key != 'created_at' && $key != 'updated_at'){
       ?>
       <div class="form-group">
       <label class="control-label col-sm-3"><? echo $att?></label>
       <div class="col-sm-4">
       <?= Select2::widget([
            'name' => 'columns['.$key.']', 
            'id' => $key, 
            'data' => $columns,
            'options' => ['placeholder' => 'Select Column ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
       </div>
       </div>
  <? 
   }}
?>
<div class="form-group">
   <label class="control-label col-sm-3">Keywords:</label>
   <div class="col-sm-4">
   <?= Select2::widget([
        'name' => 'columns[keywords]', 
        'id' => $key, 
        'data' => $columns,
        'options' => ['placeholder' => 'Select Column ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>
   </div>
 </div>
 <div class="box-footer">
   <?echo Html::button('<span class="glyphicon glyphicon-check"></span> Start Import', [ 'class' => 'btn btn-primary', 'id'=> 'import_step2' ]);?>
 </div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
 $("#import_step2").click(function(){
     data = $("#import_form").serialize(); 
     $("#step3 a").click();
//     console.log(data);
     $.ajax({
        type: 'POST',
        url: '<?=Yii::$app->UrlManager->CreateUrl('import/do-import')?>',
        data: data,
        success: function(data){
//            console.log(data);
            $("#step3 a").click();
            $("#w0-tab2").html(data);
            $("#finished").show();
            $("#loading").hide();
            //results = $.parseJSON(data);
//            if(results.status == 'success'){
//                
//            }else{
//                $.errorHandler().setError('Error:',results.errors);
//            }
        }
     });
 });
});

</script>
 


