<?php 
use backend\models\ProductsSearch;
?>
<div class="header">
    <h3 class="manufacture_<?=$model['MID']?>"><?=$model['name']?></h3>
    <a href="javascript:void()" class="scroll-top hide-tablet hide-desktop" data-target=".wishlist-page-content">Top</a>
    <div class="products-menu hide-mobile">
        <a href="#" class="trigger">Menu</a>
        <div class="popup-content">
            <div class="filters group-filter" data-mid="<?=$model['MID']?>">
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
                            <a href="#" class="quick-ship <?=(isset($params['quick_ship']) && $params['quick_ship'] > 0 ? "active" : "")?>">
                                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire-selector/quick-ship.png" alt="Quick Ship">
                            </a>
                        </li>
                        <li>
                            <a href="#" class="led-only <?=(isset($params['led']) && $params['led'] > 0 ? "active" : "")?>">
                                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire-selector/led-only.png" alt="Quick Ship">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="categories">
                <?php 
                if(isset($manufactures) && count($manufactures) > 0) {
//                    print_r($manufactures);die();
                    ?>
                    <ul>
                        <?php 
                        foreach($manufactures as $manufacture) {
                            ?>
                            <li><a href="javascript:void(0)" class="scroll-top" data-target="h3.manufacture_<?=$manufacture['MID']?>"><?=$manufacture['name']?></a></li>
                            <?php 
                        }
                        ?>
                    </ul>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

</div>
<div class="group-results">
    <?php 
        $params['MID'] = $model['MID'];
        $dataProvider = ProductsSearch::searchProductsByManufactureID($params);
        echo $this->render("_wishlist-products-group-results-list",[
            'dataProvider'=>$dataProvider,
        ]);
    ?>
</div>
<!--<div class="group-results">
    <ul class="products-group">
        <li class="item product-box">
            <p>Hornet HP Pendant Light</p>
            <div class="thumb" onclick="showAddToWishlistPopUp();">
                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire-selector/thumbs-middle.jpg">
            </div>
            <div class="specifications">LED</div>
            <a href="#" class="remove-item">Remove Item</a>
        </li>
    </ul>
</div>-->