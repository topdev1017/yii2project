<?php

namespace backend\models\base;

use Yii;

/**
 * This is the base-model class for table "slider_images".
 *
 * @property integer $SliderImagesID
 * @property integer $sliderID
 * @property integer $imageID
 * @property integer $orderID
 */
class SliderImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slider_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sliderID', 'imageID'], 'required'],
            [['sliderID', 'imageID', 'orderID'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SliderImagesID' => 'Slider Images ID',
            'sliderID' => 'Slider ID',
            'imageID' => 'Image ID',
            'orderID' => 'Order ID',
        ];
    }
}
