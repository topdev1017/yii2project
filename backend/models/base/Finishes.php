<?php

namespace backend\models\base;

use Yii;

/**
 * This is the base-model class for table "finishes".
 *
 * @property integer $FID
 * @property string $name
 */
class Finishes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'finishes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'FID' => 'Fid',
            'name' => 'Name',
        ];
    }
}
