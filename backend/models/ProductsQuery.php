<?php
namespace backend\models;
use Yii;
use creocoder\taggable\TaggableQueryBehavior;

class ProductsQuery extends \yii\db\ActiveQuery
{
    public function behaviors()
    {
        return [
            TaggableQueryBehavior::className(),
        ];
    }
}

?>