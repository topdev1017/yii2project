<?php

namespace backend\models\base;

use Yii;

/**
 * This is the base-model class for table "categories".
 *
 * @property integer $CID
 * @property integer $parent_ID
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_ID', 'name', 'slug', 'description'], 'required'],
            [['parent_ID', 'status'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'slug'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CID' => 'Cid',
            'parent_ID' => 'Parent  ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'description' => 'Description',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
