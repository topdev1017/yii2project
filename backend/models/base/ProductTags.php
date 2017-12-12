<?php

namespace backend\models\base;

use Yii;

/**
 * This is the base-model class for table "product_tags".
 *
 * @property integer $PTID
 * @property integer $product_id
 * @property integer $TID
 */
class ProductTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'tag_id'], 'required'],
            [['product_id', 'tag_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PTID' => 'Ptid',
            'product_id' => 'Product ID',
            'tag_id' => 'Tag ID',
        ];
    }
}
