<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "wishlist".
 */
class Wishlist extends \backend\models\base\Wishlist
{
    public function getWishlistCount() {
        if(Yii::$app->user->isGuest) {
            if(Yii::$app->request->cookies->has('wlifi-wishlist-products')) {
                $cookie = Yii::$app->request->cookies->getValue('wlifi-wishlist-products');
                $cookie_arr = unserialize($cookie);
                return count($cookie_arr);
            } else {
                return 0;
            }
        } else {
            // TO DO - check if user has wishlists saved in the db, and if the product is in that wishlist
            $products = WishlistProducts::find()->where(['UID' => Yii::$app->user->id])->count();
            return $products;
            
        }
    }
}
