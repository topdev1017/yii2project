<?php

use backend\assets\SortableAsset;
use yii\helpers\Html;
use yii\widgets\ListView;;

use backend\models\Categories;
use kartik\sortable\Sortable;

use yii\bootstrap\ActiveForm;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
* @var backend\models\ProductsCategories $searchModel
*/

SortableAsset::register($this);

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="categories-index">

    <?php //     echo $this->render('_search', ['model' =>$searchModel]);
    ?>

    <div class="clearfix">
        <p class="pull-left">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> New Categories', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>
    
    <?php 
    
    $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false,'id'=>'categories-sort-form']);
    
    ?>
    <ul class="sort-categories sortable-style">
    <?php Categories::createSortCategoriesTree(); ?>
    </ul>
    <?php
    
    /*echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_sort-item',
        'viewParams'=> ['form'=>$form],
        'options' => [
            'class' => 'sort-categories list-group',
            'tag' => 'ul'
        ],
        'itemOptions' => [
            'tag' => 'li',
            'class' => 'item list-group-item'
        ]
    ]);*/
    ActiveForm::end();
    // just to include the sortable assets
    echo Sortable::widget([]);
    ?>
    
    <script type="text/javascript">
    $(document).ready(function() {
        $('.sort-categories').nestedSortable({
            handle: '.handle',
            items: 'li',
            listType: 'ul',
            toleranceElement: '> div',
            isTree:true,
            disableParentChange:true,
            stop: function(e) {
                var data = $(this).nestedSortable('serialize');
                $.ajax({
                    url: '<?=Yii::$app->urlManager->createUrl(['categories/update-sort'])?>',
                    method:'post',
                    data: data,
                    dataType: 'json',
                    success:function(response) {
                        
                    }
                })
            }
        })
        
    });
    </script>
</div>
