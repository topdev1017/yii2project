<?php

namespace backend\models\base;

use Yii;

/**
 * This is the base-model class for table "wishlist_products".
 *
 * @property integer $WID
 * @property integer $PID
 */
class WishlistProducts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wishlist_products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PID','UID'], 'required'],
            [['PID','UID'], 'integer'],
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
            'PID' => 'Pid',
        ];
    }
}
