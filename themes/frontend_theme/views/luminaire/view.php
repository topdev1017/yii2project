<?php
use yii\web\JsExpression;

use backend\models\Categories;

frontend\assets\LuminaireAsset::register($this);
?>

<div class="main-content">


    <?=$this->render("//general_partial/_sidebar-ls",['current_category' => $model->CID])?>

    <div class="luminaire-selector-content main-content-of-page ajax-content">
        <div class="filters main-filter" data-cid="<?=$model->CID?>">
            <div class="breadcrumbs">
                <?php 
                Categories::generateBreadcrumbs($model->CID);
                ?>
            </div>
            <h3><?=$model['name']?></h3>
            <div class="thumb-filter filter">
                <span class="title">Thumb Size:</span>
                <ul>
                    <li><a href="#" data-size="small"></a></li>
                    <li><a href="#" data-size="medium" class="active"></a></li>
                    <li><a href="#" data-size="large"></a></li>
                </ul>
            </div>
            <div class="by-filter filter">
                <span class="title">Filter By:</span>
                <ul>
                    <li>
                        <a href="#" class="quick-ship">
                            <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire-selector/quick-ship.png" alt="Quick Ship">
                        </a>
                    </li>
                    <li>
                        <a href="#" class="led-only">
                            <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire-selector/led-only.png" alt="Led">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="clear"></div>
            <div class="filter manufacture-list show-mobile hide-tablet hide-desktop">
                <div class="field">
                    <select class="mobile-scroll-to" placeholder="Manufacture List:">
                        <option disabled selected>Manufacture List:</option>
                        <?php 
                        $manufactures = $dataProvider->getModels();
                        if(isset($manufactures) && count($manufactures) > 0) {
                            foreach($manufactures as $manufacture) {
                                ?>
                                <option value="<?=$manufacture['MID']?>"><?=$manufacture['name']?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div id="results-content">
            <?=$this->render("_view_list",['dataProvider' => $dataProvider,'params'=>$params]);?>
        </div>
    </div>
</div>