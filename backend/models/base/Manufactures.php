<?php

namespace backend\models\base;

use Yii;

/**
 * This is the base-model class for table "manufactures".
 *
 * @property integer $MID
 * @property string $name
 * @property string $url
 * @property string $image
 * @property string $cost_range
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class Manufactures extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manufactures';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'url'], 'required'],
            [['cost_range'], 'integer'],
            [['status'], 'integer'],
            [['no_iframe'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 250],
            [['url'], 'string', 'max' => 300],
            [['image'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'MID' => 'Mid',
            'name' => 'Name',
            'url' => 'Url',
            'image' => 'Image',
            'cost_range' => 'Cost Range',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
