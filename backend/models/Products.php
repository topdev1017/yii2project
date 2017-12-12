<?php

namespace backend\models;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use Yii;
use backend\models\ProductsQuery;
use backend\models\ProductsTags;
use backend\models\ProductCategories;
use backend\models\Tags;
use creocoder\taggable\TaggableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "products".
 */
class Products extends \backend\models\base\Products
{
   public $MID;
    public function behaviors()
    {
        return [
            'taggable' => [
                'class' => TaggableBehavior::className(),
//                 'tagNamesAsArray' => true,
                 'tagRelation' => 'tagsNames',
                 'tagNameAttribute' => 'name',
                 'tagFrequencyAttribute' => 'no_used',
            ],
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    /**
         * This is invoked after the record is saved.
         */
        //public function afterSave()
//        {
//                parent::afterSave();
//                echo $this->id;
//        }
    
    public function getTagsNames(){
      return $this->hasMany(Tags::className(), ['TID' => 'tag_id'])->viaTable('product_tags', ['product_id' => 'PID']);
       
    }
    
    public function getProductCategories(){
        return $this->hasMany(ProductCategories::className(), ['PID' => 'PID']);
    }
    
    public function getCategory(){
      return $this->hasMany(Categories::className(), ['CID' => 'CID'])->via("productCategories");
       
    }
    
    public function getSpecs() {
        $product_cats = $this->productCategories;
        $is_led = false;
        $is_quick_ship = false;
        if($product_cats && count($product_cats) > 0) {
            foreach($product_cats as $cats) {
//                echo $cats->CID;
                if(in_array($cats->CID,[13,22])) {
                    $is_led = true;
                }
                
                if(in_array($cats->CID,[2,15])) {
                    $is_quick_ship = true;
                }
            }
        }
        if($is_led) {
            echo "LED";
        }
        if($is_led && $is_quick_ship) {
            echo " + ";
        }
        if($is_quick_ship) {
            echo "Quick Ship";
        }
        
        if(!$is_quick_ship && !$is_led) {
            echo "More Info";
        }
    }
    /*public function getCategory(){
      return $this->hasMany(Categories::className(), ['CID' => 'CID'])->viaTable('product_categories', ['PID' => 'PID']);
       
    }*/
    
    public function getProductSizes(){
        return $this->hasMany(ProductSizes::className(), ['PID' => 'PID']);
    }
    
    public function getSize(){
      return $this->hasMany(Sizes::className(), ['SID' => 'SID'])->via("productSizes");
       
    }
    
    public function getProductFinishes(){
        return $this->hasMany(ProductFinishes::className(), ['PID' => 'PID']);
    }
    
    public function getFinish(){
      return $this->hasMany(Finishes::className(), ['FID' => 'FID'])->via("productFinishes");
       
    }
    
    public function getManufacture(){
      return $this->hasOne(Manufactures::className(), ['MID' => 'manufacture_id']);
       
    }
    
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new ProductsQuery(get_called_class());
    }

    
   
    
    public function getCostRangeArray(){
        $array = [
            ['value' => '1', 'name' => 'Budget Grade'],
            ['value' => '2', 'name' => 'Mid Grade'],
            ['value' => '3', 'name' => 'Premium'],
            ['value' => '4', 'name' => 'Specification Grade'],
        ];
        return ArrayHelper::map($array, 'value', 'name');
    }
    
    public function showCostName($cost_no){
        switch ($cost_no) {
            case 1:
                return 'Budget Grade';
                break;
            case 2:
                return 'Mid Grade';
                break;
            case 3:
                return 'Premium';
                break;
            case 4:
                return 'Specification Grade';
                break;
        }
    }
    
    public function isInLedCategory($pid){
        $categories = ProductCategories::find()->where('PID ='.$pid)->andWhere('CID IN (12, 23)')->count();
        if($categories>0){
            return true;
        }
        return false;
    }
    
    public function isInQuickShipCategory($pid){
        $categories = ProductCategories::find()->where('PID ='.$pid)->andWhere('CID IN (1, 13)')->count();
        if($categories>0){
            return true;
        }
        return false;
    }
    
    public function isInWishlist() {
        if(Yii::$app->user->isGuest) {
            if(Yii::$app->request->cookies->has('wlifi-wishlist-products')) {
                $cookie = Yii::$app->request->cookies->getValue('wlifi-wishlist-products');
                $cookie_arr = unserialize($cookie);
                if(in_array($this->PID,$cookie_arr)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            // TO DO - check if user has wishlists saved in the db, and if the product is in that wishlist
            return false;
        }
    }
    
    
}
