<?php

namespace backend\models\base;

use Yii;

/**
 * This is the base-model class for table "pages".
 *
 * @property integer $PgID
 * @property string $title
 * @property string $content
 * @property string $slug
 * @property string $created_at
 * @property string $updated_at
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'slug'], 'required'],
            [['content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'slug'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PgID' => 'Pg ID',
            'title' => 'Title',
            'content' => 'Content',
            'slug' => 'Slug',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
