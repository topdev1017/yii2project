<div class="box box-primary" id="finished" style="display: none;">
    <div class="box-header">
      <h3 class="box-title">Import Finished</h3>
    </div><!-- /.box-header -->

<div class="box-body">
<p>
    There were <?=$result['total_imported']?> rows added to table <?=$model->table?>.
</p>
<?if(!empty($result['errors'])){?> 
    <p>Here are the errors occured while running import:</p>
    <?foreach($result['errors'] as $key=>$value){?>
       <p>On row <?=$key?>:</p>
       <? print_r($value); ?>
       <hr />
    <?}?>
<?}?>
</div>
</div>

<div class="box box-primary" id="loading" style="display: block;">
    <div class="box-header">
      <h3 class="box-title">Please wait while the import is loading your data!</h3>
    </div><!-- /.box-header -->
</div>

