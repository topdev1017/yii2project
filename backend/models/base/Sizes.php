<?php

namespace backend\models\base;

use Yii;

/**
 * This is the base-model class for table "sizes".
 *
 * @property integer $SID
 * @property string $name
 */
class Sizes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sizes';
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
            'SID' => 'Sid',
            'name' => 'Name',
        ];
    }
}
