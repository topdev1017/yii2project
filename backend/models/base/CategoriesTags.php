<?php

namespace backend\models\base;

use Yii;

/**
 * This is the base-model class for table "categories_tags".
 *
 * @property integer $CTID
 * @property integer $category_ID
 * @property integer $TID
 */
class CategoriesTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_ID', 'TID'], 'required'],
            [['category_ID', 'TID'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CTID' => 'Ctid',
            'category_ID' => 'Category  ID',
            'TID' => 'Tid',
        ];
    }
}
