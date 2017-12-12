<?php 
use backend\models\Products;
use backend\models\Manufactures;
?>
<h1>Broken Url Reported</h1>

<p>The following url is broken: <?=$url?></p>

<?php 
$models = Manufactures::find()->where(['LIKE','url',$url])->all();
if($models) {
    ?>
    <h3>This URL is use for the following manufactures:</h3>
    <?php
    foreach($models as $model) {
        ?>
        <p>ID: <?=$model->MID?> - <?=$model->name?> </p>
        <?php
    }
}
?>
<p>&nbsp;</p>
<?php 
$models = Products::find()->where(['LIKE','manufacture_product_url',$url])->all();
if($models) {
    ?>
    <h3>This URL is use for the following products:</h3>
    <?php
    foreach($models as $model) {
        ?>
        <p>ID: <?=$model->PID?> - <?=$model->name?> </p>
        <?php
    }
}
?>
<p>&nbsp;</p>
<?php 
if(isset($extra_data)) {
    ?>
    <h3>Extra Information:</h3>
    <?php
    echo $extra_data;
}
?>