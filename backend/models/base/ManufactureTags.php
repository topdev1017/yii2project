<?php

namespace backend\models\base;

use Yii;

/**
 * This is the base-model class for table "manufacture_tags".
 *
 * @property integer $MID
 * @property integer $manufacture_ID
 * @property integer $tag_id
 */
class ManufactureTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manufacture_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['manufacture_ID', 'tag_id'], 'required'],
            [['MID', 'manufacture_ID', 'tag_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'MID' => 'Mid',
            'manufacture_ID' => 'Manufacture  ID',
            'tag_id' => 'Tag ID',
        ];
    }
}
