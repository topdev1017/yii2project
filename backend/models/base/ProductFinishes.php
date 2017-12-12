<?php

namespace backend\models\base;

use Yii;

/**
 * This is the base-model class for table "product_finishes".
 *
 * @property integer $PFID
 * @property integer $PID
 * @property integer $FID
 */
class ProductFinishes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_finishes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PID', 'FID'], 'required'],
            [['PID', 'FID'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PFID' => 'Pfid',
            'PID' => 'Pid',
            'FID' => 'Fid',
        ];
    }
}
