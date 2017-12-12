<?php

namespace backend\models;
use yii\helpers\ArrayHelper;
use creocoder\taggable\TaggableBehavior;

use backend\models\Specialized;
use backend\models\ManufactureSpecialized;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use Yii;

/**
 * This is the model class for table "manufactures".
 */
class Manufactures extends \backend\models\base\Manufactures
{
    public $letter;
    
    public function behaviors()
    {
        return [
            'taggable' => [
                'class' => TaggableBehavior::className(),
//                 'tagNamesAsArray' => true,
                 'tagRelation' => 'tagsNames',
                 'tagNameAttribute' => 'name',
                 'tagFrequencyAttribute' => 'no_used',
            ],
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    public function getTagsNames(){
      return $this->hasMany(Tags::className(), ['TID' => 'tag_id'])->viaTable('manufacture_tags', ['manufacture_ID' => 'MID']);
       
    }
    
    public function getProducts() {
        return $this->hasMany(Products::className(), ['manufacture_id' => 'MID']);
    }
    
    
    public function getManufacturesSpecialized(){
        return $this->hasMany(ManufactureSpecialized::className(), ['MID' => 'MID']);
    }
    
    public function getSpecialized(){
      return $this->hasMany(Specialized::className(), ['SpID' => 'SpID'])->via("manufacturesSpecialized");
       
    }
    
    public function getCostRangeArray(){
        $array = [
            ['value' => '1', 'name' => 'Budget Grade'],
            ['value' => '2', 'name' => 'Mid Grade'],
            ['value' => '3', 'name' => 'Premium'],
            ['value' => '4', 'name' => 'Specification Grade'],
        ];
        return ArrayHelper::map($array, 'value', 'name');
    }
    
    public function showCostName($cost_no){
        switch ($cost_no) {
            case 1:
                return 'Budget Grade';
                break;
            case 2:
                return 'Mid Grade';
                break;
            case 3:
                return 'Premium';
                break;
            case 4:
                return 'Specification Grade';
                break;
        }
    }
    
    public function createABCFilters($dataProvider) {
        $html = "";
        $search = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','#'];
        $models = $dataProvider->getModels();
        $html = '<ul class="abc">';
        foreach($search as $letter) {
            $html .= '<li> ';
            $exists = false;
            foreach($models as $model) {
                if(strtoupper($model['letter']) == strtoupper($letter)) {
                    $exists = true;
                } 
            }
            if($exists) {
                $html .= '<a href="javascript:void(0)" class="scroll-top" data-target=".manufacture-group_'.($letter == "#" ? "numeric" : $letter).'">'.$letter.'</a>';
            } else {
                $html .= $letter;
            }
            $html .= '</li>';
        }
        
        $html .= '</ul>';
        
        return $html;
    }
    
    public function getManufacturesForSelect($params) {
        
        $query = Manufactures::find();
        if(isset($params['cost_range'])) {
            $query->andFilterWhere([
                'cost_range' => $params['cost_range'],
            ]);
        }
        $query->orderBy("(name REGEXP '^[A-Z]') DESC, name ASC");
        $models = $query->all();
        
        
        $return_arr = [];
        foreach($models as $model) {
            $return_arr[$model->name] = $model->name;
        }
        return $return_arr;
        
    }
    
    public function linkManufacture($manufacture,$text=false) {
        $query = Manufactures::find();
        $query->andFilterWhere(["LIKE","LOWER(name)",strtolower($manufacture)]);
        
        $model = $query->one();
        
        if($model) {
            if($model->no_iframe > 0) {
                $html = '<a href="'.$model->url.'" target="_blank">';
            } else {
                $html = '<a href="'.Yii::$app->urlManager->createUrl(['site/external-url','url'=>$model->url]).'" target="_blank">';
            }
            if($text !== false) {
                $html .= $text;
            } else {
                $html .= $manufacture;
            }
            
            $html .= "</a>";
            return $html;
        } else {
            return $manufacture;
        }
    }
}
