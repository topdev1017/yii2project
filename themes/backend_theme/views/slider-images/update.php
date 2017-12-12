<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\models\SliderImages $model
 */

$this->title = 'Slider Images ' . $model->SliderImagesID . ', ' . 'Edit';
$this->params['breadcrumbs'][] = ['label' => 'Slider Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->SliderImagesID, 'url' => ['view', 'SliderImagesID' => $model->SliderImagesID]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="slider-images-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> ' . 'View', ['view', 'SliderImagesID' => $model->SliderImagesID], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
        'model' => $model,
//        'dataprovider_images' => $dataprovider_images,
//        'images_search' => $images_search
	]); ?>

</div>
