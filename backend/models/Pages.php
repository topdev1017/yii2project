<?php

namespace backend\models;

use Yii;
use backend\models\Sliders;
use backend\models\Manufactures;

/**
 * This is the model class for table "pages".
 */
class Pages extends \backend\models\base\Pages
{
    
    public function parseContent() {
        
        
        $this->doShortcodes(); // process the shortcodes from the content;
    }
    
    public function doShortcodes() {
        $this->content = preg_replace_callback("/\[(\w+) (.+?)]/", array(&$this,'processShortcode'), $this->content);
    }
    
    public function processShortcode($matches) {
        // parse out the arguments
        
        $regex = '/(\w+)\s*=\s*["|\'](.*?)["|\']/';
        preg_match_all($regex,$matches[2],$attributes);
        $params = array();
        if(count($attributes) > 0) {
            foreach($attributes[1] as $i => $v) {
                $params[$v] = $attributes[2][$i];
            }
        } 

        switch($matches[1]){
            case "slider":
//                return print_r($params,true);
                if(isset($params['id'])) {
                    $slider = Sliders::findOne($params['id']);
                    if($slider) {
                        return $slider->renderSlider();
                    }
                } 
            break; 
            case "linkmanufacture":
            if(isset($params['id'])) {
                if(isset($params['text'])) {
                    return Manufactures::linkManufacture($params['id'],$params['text']);
                } else {
                    return Manufactures::linkManufacture($params['id']);
                }
                
            }
            break;
            case "settings":
                if(isset($params['param'])) {
                    switch($params['param']) {
                        case "theme_url":
                        case "template_url":
                            return Yii::$app->view->theme->baseUrl;
                        break;
                    }
                }     
            break; 
            case "externalurl":
                $arr = ['site/external-url'];
                $url = array_merge($arr,$params);
                return Yii::$app->urlManager->createUrl($url);
            break; 
            
            case "createurl":
//            
                if(isset($params['route'])) {
                    $arr = [$params['route']];
                    unset($params['route']);
                    $url = array_merge($arr,$params);
//                    return print_r($params,true);
                    return Yii::$app->urlManager->createUrl($url);
                } else {
                    return Yii::$app->urlManager->createUrl($params);
                }
                
            break;       
        }
    }
}
