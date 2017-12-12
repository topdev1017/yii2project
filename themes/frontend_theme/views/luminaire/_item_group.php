<?php 
use backend\models\ProductsSearch;

$params['MID'] = $model['MID'];
$dataProvider = ProductsSearch::searchProductsByManufactureID($params);

?>
    <div class="header">
        <h3 id="manufacture_<?=$model['MID']?>" class="manufacture_<?=$model['MID']?>"><?=$model['name']?></h3>
        <a href="javascript:void()" class="scroll-top hide-tablet hide-desktop" data-target=".luminaire-selector-content">Top</a>
        <div class="products-menu hide-mobile">
            <a href="#" class="trigger">Menu</a>
            <div class="popup-content">
                <div class="filters group-filter" data-mid="<?=$model['MID']?>" data-cid="<?=$params['CID']?>">
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
        
        echo $this->render("_item_group_list",[
            'dataProvider'=>$dataProvider,
            'manufactures'=>$manufactures,
            'model'=>$model,
            'params'=>$params,
        ]);
    ?>
    </div>