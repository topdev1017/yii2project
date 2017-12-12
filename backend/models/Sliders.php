<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sliders".
 */
class Sliders extends base\Sliders
{
    public function getSliderImages(){
        return $this->hasMany(SliderImages::className(), ['sliderID' => 'SliderID']);
    }
    
    public function renderSlider() {
        if(!empty($this->SliderID) && $this->SliderID > 0) {
            return Yii::$app->controller->renderPartial("/sliders/".$this->type,['model'=>$this]);  
        } 
    }
}
