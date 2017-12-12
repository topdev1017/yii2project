<?php

namespace backend\models\base;

use Yii;

/**
 * This is the base-model class for table "manufacture_specialized".
 *
 * @property integer $MSpID
 * @property integer $MID
 * @property integer $SpID
 */
class ManufactureSpecialized extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manufacture_specialized';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MID', 'SpID'], 'required'],
            [['MID', 'SpID'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'MSpID' => 'Msp ID',
            'MID' => 'Mid',
            'SpID' => 'Sp ID',
        ];
    }
}
