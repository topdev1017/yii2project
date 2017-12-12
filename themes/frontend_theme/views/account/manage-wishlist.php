<?php
frontend\assets\ManageWishlistAsset::register($this);

use backend\models\User;
use backend\models\Wishlist;

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<div class="main-content">
    <?=$this->render("//general_partial/_sidebar")?>
    <div class="manage-wishlist-content page-content">
        <section class="section-header">
            <div class="breadcrumbs">
                <ul>
                    <li>WFLi</li>
                    <li>
                        <?php 
                        if(Yii::$app->user->isGuest) {
                            echo "Guest";
                        } else {
                            $user = User::findOne(Yii::$app->user->id);
                            echo $user->first_name." ".$user->last_name;
                        }
                        ?>
                    </li>
                    <li>Manage Wishlist</li>
                </ul>
            </div>
            <h1>
                Welcome 
                <?php 
                if(Yii::$app->user->isGuest) {
                    echo "Guest";
                } else {
                    $user = User::findOne(Yii::$app->user->id);
                    echo $user->first_name." ".$user->last_name;
                }
                ?>
            </h1>
        </section>
        <?php 
        if(!Yii::$app->user->isGuest) {
        ?>
        <h3 class="section-title">Create New Wishlist</h3>
        <div class="section-create-wishlist">
            <?php 
            $form = ActiveForm::begin([
                'id'=>'wishlist-create-form',
                'enableClientValidation' => false
            ]);
            ?>
            <?php echo $form->field($model, 'name',['template'=>'{input}'])->textInput(['placeholder'=>'Enter Wishlist Name']); ?>
            <?= Html::submitButton('Create Wishlist', ['class' => 'create-wishlist']) ?>
<!--            <input type="submit" class="create-wishlist" value="Create Wishlist">-->
<div class="clear"></div>
            <?php echo $form->errorSummary($model); ?>
            <?php ActiveForm::end() ?>
        </div>
        <?php 
        }
        ?>
        
        <h3 class="section-title">Your Wishlist</h3>
        <div class="section-your-wishlist">
            <ul>
                <?php 
                if(Yii::$app->user->isGuest) {
                    ?>
                    <li>
                        <h3>Wishlist</h3>
                        <div class="buttons">
                            <a href="<?=Yii::$app->UrlManager->createUrl(["account/view-wishlist",'id'=>0])?>">View</a>
                            <a href="<?=Yii::$app->UrlManager->createUrl(["account/delete-wishlist",'id'=>0])?>">Delete</a>
                        </div>
                    </li>
                    <?php
                } else {
                    $wishlists = Wishlist::find()->where(["UID"=>Yii::$app->user->id])->all();
                    if($wishlists) {
                        foreach($wishlists as $wishlist) {
                            ?>
                            <li>
                                <h3><?=$wishlist->name?></h3>
                                <div class="buttons">
                                    <a href="<?=Yii::$app->UrlManager->createUrl(["account/view-wishlist",'id'=>$wishlist->WID])?>">View</a>
                                    <a href="<?=Yii::$app->UrlManager->createUrl(["account/delete-wishlist",'id'=>$wishlist->WID])?>">Delete</a>
                                </div>
                            </li>
                            <?php
                        }
                    }
                }
                ?>
                      
            </ul>
        </div>
        
    </div>
</div>