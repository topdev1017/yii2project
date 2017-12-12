<h4 class="pull-left"><a href="javascript:void(0)"><span class="glyphicon glyphicon-th-list handle" style="margin-right:10px"></span></a> <?= $model->name ?></h4>
<div class="pull-right">
<a href="<?=Yii::$app->urlManager->createUrl(['categories/update','CID'=>$model->CID])?>" class="btn btn-sm btn-primary">Edit</a>
</div>
<div class="clearfix"></div>
<?php 
echo $form->field($model, 'CID',['template'=>'{input}'])->hiddenInput(['name' => 'Categories[CID][]']);
?>
