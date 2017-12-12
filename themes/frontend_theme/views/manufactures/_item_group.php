<?php 
use backend\models\ProductsSearch;

?>
<div class="header">
    <h3 id="manufacture_<?=$model['MID']?>" class="manufacture_<?=$model['MID']?>"><?=$model['name']?> <a href="<?=Yii::$app->UrlManager->createUrl(['luminaire/view-manufacture','mid'=>$model['MID']])?>" class="show-all">Show All</a></h3>
    <a href="javascript:void()" class="scroll-top hide-tablet hide-desktop" data-target=".luminaire-selector-content">Top</a>
    <div class="products-menu hide-mobile">
        
        <a href="javascript:void(0)" class="trigger">Menu</a>
        <div class="popup-content">
            <div class="filters group-filter group" data-mid="<?=$model['MID']?>" data-cid="">
                <?php /* <div class="dropdown-filter filter">
                <select name="sort">
                <option>Sorting Options...</option>
                <option value="led" <?=(isset($params['led']) && $params['led']== 1 ? 'selected="selected"' : '')?>>View LED Only</option>
                <option value="quick_ship" <?=(isset($params['quick_ship']) && $params['quick_ship']== 1 ? 'selected="selected"' : '')?>>View Quick Ship Only</option>
                <option value="all">View All</option>
                </select>
                </div> */ ?>
                <div class="size-filter filter">
                    <div class="filter-title">Thumb Size:</div>
                    <ul>
                        <li><a href="#" data-size="small" class="<?=(Yii::$app->session->get('ls-products-size','medium') == 'small' ? 'active' : '')?>"></a></li>
                        <li><a href="#" data-size="medium" class="<?=(Yii::$app->session->get('ls-products-size','medium') == 'medium' ? 'active' : '')?>"></a></li>
                        <li><a href="#" data-size="large" class="<?=(Yii::$app->session->get('ls-products-size','medium') == 'large' ? 'active' : '')?>"></a></li>
                    </ul>
                </div>
                <div class="sorting-filter filter">
                    <div class="filter-title">Filter By:</div>
                    <ul>
                        <li>
                            <a href="javascript:void(0)" data-filter="quick_ship" class="filter-products sort-by-quick-ship <?=(isset($params['quick_ship']) && $params['quick_ship']== 1 ? 'active' : '')?>"></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" data-filter="led" class="filter-products sort-by-led <?=(isset($params['led']) && $params['led']== 1 ? 'active' : '')?>"></a>
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
    $params['MID'] = $model['MID'];
    //        echo "<pre>";
    //        print_r($params);
    //        echo "</pre>";
//    $dataProvider = ProductsSearch::searchProductsByManufactureID($params);
    echo $this->render("_item_group_list",[
        'dataProvider'=>$dataProvider,
        'model'=>$model,
        'params'=>$params,
    ]);
    ?>
</div>