<?php

namespace backend\models\base;

use Yii;

/**
 * This is the base-model class for table "wishlist".
 *
 * @property integer $WID
 * @property integer $UID
 * @property string $name
 */
class Wishlist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wishlist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UID', 'name'], 'required'],
            [['UID'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'WID' => 'Wid',
            'UID' => 'Uid',
            'name' => 'Name',
        ];
    }
}
