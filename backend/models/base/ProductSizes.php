<?php

namespace backend\models\base;

use Yii;

/**
 * This is the base-model class for table "product_sizes".
 *
 * @property integer $PSID
 * @property integer $PID
 * @property integer $SID
 */
class ProductSizes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_sizes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PID', 'SID'], 'required'],
            [['PID', 'SID'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PSID' => 'Psid',
            'PID' => 'Pid',
            'SID' => 'Sid',
        ];
    }
}
