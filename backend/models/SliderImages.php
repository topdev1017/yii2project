<?php

namespace backend\models;
use himiklab\sortablegrid\SortableGridBehavior;

use Yii;

/**
 * This is the model class for table "slider_images".
 */
class SliderImages extends base\SliderImages
{
    
    public function behaviors()
    {
        return [
            'sort' => [
                'class' => SortableGridBehavior::className(),
                'sortableAttribute' => 'orderID'
            ],
        ];
    }
    
    public function getImage()
    {
        return $this->hasOne(Images::className(), ['ImgID' => 'imageID']);
    } 
    
}
