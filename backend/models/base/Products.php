<?php

namespace backend\models\base;

use Yii;

/**
 * This is the base-model class for table "products".
 *
 * @property integer $PID
 * @property string $name
 * @property string $description
 * @property string $manufacture_product_url
 * @property string $slug
 * @property string $image
 * @property integer $manufacture_id
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class Products extends \yii\db\ActiveRecord
{
     public $tags;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'manufacture_product_url', 'slug', 'manufacture_id', 'status'], 'required'],
            [['PID', 'manufacture_id', 'status'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at', 'tags', 'cost_range','no_iframe'], 'safe'],
            [['name'], 'string', 'max' => 250],
            [['manufacture_product_url'], 'string', 'max' => 300],
            [['slug', 'image'], 'string', 'max' => 150],
//            [['PID'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PID' => 'Pid',
            'name' => 'Name',
            'description' => 'Description',
            'manufacture_product_url' => 'Manufacture Product Url',
            'slug' => 'Slug',
            'image' => 'Image',
            'cost_range' => 'Cost Range',
            'manufacture_id' => 'Manufacture ID',
            'status' => 'Active',
            
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
