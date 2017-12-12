<?php 
use backend\models\Categories;
use backend\models\Wishlist;
use backend\models\Specialized;
if(!isset($current_category)) {
    $current_category = "";
}
?>
<div class="main-menu">
    <div class="categories">
        <ul>
            <?php 
            if(!Yii::$app->user->isGuest) {
            ?>
            <li>
                <h3>WELCOME</h3>
                <ul>
                    <li><a href="<?=Yii::$app->UrlManager->createUrl("account/manage-wishlist")?>">Manage Wishlist</a></li>
                    <li><a href="<?=Yii::$app->UrlManager->createUrl("account/manage-account")?>">Manage Account</a></li>
                    <li><a href="#">Logout</a></li>
                </ul>
            </li>
            <li>
                <h3>YOUR WISHLIST</h3>
                <ul>
                    <?php 
                    $wishlists = Wishlist::find()->where(["UID"=>Yii::$app->user->id])->all();
                    if($wishlists) {
                        foreach($wishlists as $wishlist) {
                            ?>
                            <li><a href="<?=Yii::$app->UrlManager->createUrl(["account/view-wishlist",'id'=>$wishlist->WID])?>"><?=$wishlist->name?></a></li>
                            <?php
                        }
                    }
                    ?>
                    <!--<li><a href="<?=Yii::$app->UrlManager->createUrl("account/manage-wishlist")?>">List All Wishlist Here</a></li>-->
                    <li><a href="<?=Yii::$app->UrlManager->createUrl("account/manage-wishlist")?>" class="red">+ Add new wishlist</a></li>
                </ul>
            </li>
            <?php } else {?>
            <li>
                <h3>WISHLIST</h3>
                <ul>
                    <li><a href="<?=Yii::$app->UrlManager->createUrl(["account/manage-wishlist"])?>" class="wishlist-counter"><span><?=Wishlist::getWishlistCount()?></span> Items In Wishlist</a></li>
                    <li><a href="<?=Yii::$app->UrlManager->createUrl(["account/view-wishlist","id"=>0])?>">View wishlist</a></li>
                </ul>
            </li>
            <?php } ?>
            <?=Categories::createCategoriesTree(0,$current_category);?>
            <?=Specialized::createSpecializedTree();?>
        </ul>
    </div>

    <div class="comercial">
        <p class="comercial_take_a_look">TAKE A LOOK AT</p>
        <p class="whats_new">WHAT'S NEW!</p>
        <a href="http://www.hubbelllighting.com/company/illuminations/" target="_blank" class="click_here">CLICK HERE</a>
    </div>
</div>