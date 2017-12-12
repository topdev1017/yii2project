<?php

namespace backend\models\base;


use Yii;

/**
 * This is the base-model class for table "images".
 *
 * @property integer $ImgID
 * @property string $file
 * @property string $embed
 * @property string $caption
 * @property string $type
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['caption', 'type'], 'required'],
            ['file', 'required',  'when' => function($model) {
                if($model->type == 'image'){
                        return true;
                    }else{
                        return false;
                }
            }, 'message' => 'Please provide a file'],
            [['file','embed'], 'required',  'when' => function($model) {
                if($model->type == 'video'){
                        return true;
                    }else{
                        return false;
                }
            }, 'message' => 'Please provide the embed code'],
            
            [['embed', 'caption', 'type'], 'string'],
            [['file'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ImgID' => 'Img ID',
            'file' => 'File',
            'embed' => 'Embed',
            'caption' => 'Caption',
            'type' => 'Type',
        ];
    }
}
