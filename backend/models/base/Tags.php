<?php

namespace backend\models\base;

use Yii;

/**
 * This is the base-model class for table "tags".
 *
 * @property integer $TID
 * @property string $name
 * @property integer $no_used
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'no_used'], 'required'],
            [['no_used'], 'integer'],
            [['name'], 'string', 'max' => 400]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TID' => 'Tid',
            'name' => 'Name',
            'no_used' => 'No Used',
        ];
    }
}
