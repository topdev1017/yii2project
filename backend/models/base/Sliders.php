<?php

namespace backend\models\base;

use Yii;

/**
 * This is the base-model class for table "sliders".
 *
 * @property integer $SliderID
 * @property string $name
 * @property string $type
 * @property string $video_button
 * @property string $description
 */
class Sliders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sliders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            ['video_button', 'required',  'when' => function($model) {
                if($model->type == 'slider_video_full_width'){
                        return true;
                    }else{
                        return false;
                }
            }, 'message' => 'Please provide a link'], 
            ['description', 'required',  'when' => function($model) {
                if($model->type == 'slider_video_full_width' || $model->type == 'slider_with_right_content'){
                        return true;
                    }else{
                        return false;
                }
            }, 'message' => 'Please provide the content'],
            [['type', 'description'], 'string'],
            [['name', 'video_button'], 'string', 'max' => 250],
            [['name','type','description','video_button'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SliderID' => 'Slider ID',
            'name' => 'Name',
            'type' => 'Type',
            'video_button' => 'Button Link',
            'description' => 'Content',
        ];
    }
}
