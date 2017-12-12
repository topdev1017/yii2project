<?php 
use backend\models\Manufactures;
use backend\models\ProductSizes;
use backend\models\ProductFinishes;
use backend\models\Sizes;
use backend\models\Wishlist;
use backend\models\WishlistProducts;
use backend\models\Finishes;
?>
    <a href="javascript:void(0)" class="wishlist-popup-close">X</a>
    <div class="wishlist-popup-wrapper">
        <div class="wishlist-popup-content">
            <div class="wishlist-popup-content-left">
                <div class="wishlist-popup-thumb">
                    <?php 
                    if(!empty($model['image']) && is_file(Yii::$app->basePath."/../resources/products/".$model['image'])) {
                        $image = Yii::getAlias('@web')."/../../resources/products/".$model['image'];
                    } else {
                        $image = Yii::$app->view->theme->baseUrl."/resources/images/wishlist-popup/wishlist-popup-image.jpg";
                    }
                    ?>
                    <img src="<?=$image?>">
                </div>
                <p class="wishlist-popup-madeby">Made by:</p>
                <p class="wishlist-popup-product-name">
                    <?php 
                    $manuf = Manufactures::findOne($model['manufacture_id']);
                    if($manuf) {
                        echo strtoupper($manuf['name']);
                    }
                    ?>
                </p>
            </div>
            <div class="wishlist-popup-content-right">
                <p class="wishlist-popup-firm"><?=$model->name?></p>
                <p><?=$model->description?></p>
                <div class="wishlist-popup-sizes-wrapper">
                    <?php 
                    $product_sizes = ProductSizes::find()->where(['PID'=>$model->PID])->all();
                    if($product_sizes && count($product_sizes)) {
                        ?>
                        <h3>Sizes:</h3>
                        <?php
                        foreach($product_sizes as $product_size) {
                            $ps = Sizes::findOne($product_size->SID);
                            if($ps) {
                              ?>
                            <div class="wishlist-popup-size"><?=$ps->name?></div>
                            <?php  
                            }
                            
                        }
                    }
                    ?>
                    
                    <?php 
                    $product_finishes = ProductFinishes::find()->where(['PID'=>$model->PID])->all();
                    if($product_finishes && count($product_finishes)) {
                        ?>
                        <h3>Finishes:</h3>
                        <?php
                        foreach($product_finishes as $product_finish) {
                            $pf = Finishes::findOne($product_finish->FID);
                            if($pf) {
                              ?>
                            <div class="wishlist-popup-size"><?=$pf->name?></div>
                            <?php  
                            }
                            
                        }
                    }
                    ?>
                </div>
                <div class="wishlist-popup-options-wrapper">
                    <?php 
                        $cost_range = false;
                        if(!empty($model->cost_range)) {
                            $cost_range = $model->cost_range;
                        } else {
                            $manuf = Manufactures::findOne($model['manufacture_id']);
                            if($manuf && !empty($manuf->cost_range)) {
                                $cost_range = $manuf->cost_range;
                            }
                        }
                        
                        if($cost_range) {
                            
                    ?>
                    <div class="wishlist-cost-range active_<?=$cost_range?>">
                        <div>BUDGET</div>
                        <div class="range-wrap">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div>SPECIFICATION</div>
                    </div>
                    <?php } ?>
                    <?php if($model->led == 1) : ?>
                    <div class="wishlist-led"></div>
                    <?php endif; ?>
                    
                    <?php if($model->quick_ship == 1) : ?>
                    <div class="wishlist-quick-ship"></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="wishlist-popup-buttons">
            <div class="response"></div>
            <div class="wishlist-popup-button-left">
                <?php 
                if(Yii::$app->user->isGuest) {
                    ?>
                    <a href="#" class="add-to-wishlist <?=($model->isInWishlist() ? "added" : "")?>" data-pid="<?=$model->PID?>"><?=($model->isInWishlist() ? "Added To Wishlist" : "Add To Wishlist")?></a>
                    <?php
                } else {
                    ?>
                    <select class="wishlist-select">
                        <option value="0">Choose Wishlist</option>
                        <?php 
                        $wishlists = Wishlist::find()->where(['UID'=>Yii::$app->user->id])->all();
                        foreach($wishlists as $wishlist) {
                            $wproducts = WishlistProducts::find()->where(['WID'=>$wishlist->WID,
                        'PID'=>$model->PID])->one();
                            ?>
                            <option <?=($wproducts ? 'disabled' : "")?> value="<?=$wishlist->WID?>"><?=$wishlist->name?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <a href="#" class="add-to-wishlist  <?=($model->isInWishlist() ? "added" : "small")?>" data-pid="<?=$model->PID?>"><?=($model->isInWishlist() ? "Added To Wishlist" : "Add To Wishlist")?></a>
                    <?php
                }
                ?>
                <!--<select class="wishlist-select">
                <option>Choose Wishlist</option>
                </select>-->
                
            </div>
            <div class="wishlist-popup-button-right">
                <?php 
                if($model->no_iframe > 0 || (isset($manuf) && !empty($manuf) && $manuf->no_iframe > 0)) {
                    ?>
                    <a href="<?=$model->manufacture_product_url?>" target="_blank" class="learn-more">Learn More</a>
                    <?php
                } else {
                    ?>
                    <a href="<?=Yii::$app->urlManager->createUrl(['site/external-url','url'=>urlencode($model->manufacture_product_url),'target'=>$target])?>" target="_blank" class="learn-more">Learn More</a>
                    <?php
                }
                ?>
                
            </div>
        </div>
    </div>
<script type="text/javascript">
$(document).ready(function() {
    $(".wishlist-popup-close").click(function() {
        var api = $('.show-product-info').qtip("api"); 
        api.hide;
    });
    
    $(".add-to-wishlist").click(function(e) {
        e.preventDefault();
        var that = $(this);
        var container = that.closest(".wishlist-popup-buttons");
        var select = container.find(".wishlist-select");
        var responseDiv = container.parent().find(".response");
        
        var data = {
            pid: that.attr("data-pid"),
            wid: select.val(),
            '<?= Yii::$app->request->csrfParam; ?>': '<?= Yii::$app->request->csrfToken; ?>'
        }
        
        if(!that.hasClass("added")) {
            responseDiv.removeAttr("class").addClass("response");
            responseDiv.slideUp(300);
            $.ajax({
                url: '<?=Yii::$app->UrlManager->createUrl("account/add-to-wishlist")?>',     
                type: 'POST',
                data: data,
                dataType: "json",
                success: function(response) {
                    if(response.status == "OK") {
                        responseDiv.html("Added to wishlist").addClass("success").slideDown(300).delay(5000).slideUp(300);
                        select.find('option[value="'+select.val()+'"]').attr("disabled","disabled");
                        that.html("Added to wishlist").addClass("added");
                        
                        $(".wishlist-counter span").html(response.count);
                    } else {
                        responseDiv.html(response.message).addClass("error").slideDown(300).delay(5000).slideUp(300);
                    }
                }
            })
        }
        
    });
    
})
</script>