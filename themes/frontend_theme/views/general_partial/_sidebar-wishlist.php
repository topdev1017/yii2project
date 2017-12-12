<?php 
use backend\models\Categories;
use backend\models\Wishlist;
use backend\models\Specialized;

if(!isset($current_category)) {
    $current_category = "";
}
?>
<div class="main-menu" id="sidebar">
    <div class="main-menu-wrapper">
        <div class="categories">
            <ul>
                <li>
                    <h3>EMAIL WISHLIST</h3>
                    <div class="email-wishlist simulate-dropdown">
                        <?=$this->render("_wishlist-email-form",['model'=>$model])?>
                    </div>
                </li>
                <?php 
                if(!Yii::$app->user->isGuest) {
                    ?>

                    <li>
                        <h3>WELCOME</h3>
                        <ul>
                            <li><a href="<?=Yii::$app->UrlManager->createUrl("account/manage-wishlist")?>">Manage Wishlist</a></li>
                            <li><a href="<?=Yii::$app->UrlManager->createUrl("account/manage-account")?>">Manage Account</a></li>
                            <li><a href="<?=Yii::$app->UrlManager->createUrl("site/logout")?>">Logout</a></li>
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
                            <li><a href="<?=Yii::$app->UrlManager->createUrl(["account/view-wishlist","id"=>0])?>" class="wishlist-counter"><span><?=Wishlist::getWishlistCount()?></span> Items In Wishlist</a></li>
                            <li><a href="<?=Yii::$app->UrlManager->createUrl(["account/view-wishlist","id"=>0])?>">View / Email Wishlist</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                <?=Categories::createCategoriesTree(0,$current_category);?>
                <?=Specialized::createSpecializedTree();?>

            </ul>
        </div>

    </div>
</div>