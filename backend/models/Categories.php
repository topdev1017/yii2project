<?php

namespace backend\models;
use creocoder\taggable\TaggableBehavior;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use Yii;

use yii\db\Query;

/**
 * This is the model class for table "categories".
 */
class Categories extends \backend\models\base\Categories
{
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
            //'timestamp' => [
//                'class' => TimestampBehavior::className(),
//                'createdAtAttribute' => 'created_at',
//                'updatedAtAttribute' => 'updated_at',
//                'value' => new Expression('NOW()'),
//            ],
        ];
    }
    public function getTagsNames(){
      return $this->hasMany(Tags::className(), ['TID' => 'TID'])->viaTable('categories_tags', ['category_ID' => 'CID']);
       
    } 
    
   // public function getProductCategories(){
//        return $this->hasMany(ProductCategories::className(), ['PID' => 'PID']);
//    }
//    
//    public function getCategory(){
//      return $this->hasMany(Categories::className(), ['CID' => 'CID'])->via("productCategories");
//       
//    }
    public static function getCategoriesList($parent=0) {
        $return = [];
//        $categories = Categories::find()->where(['parent_id' => $parent,'status'=>'1'])->orderBy('name ASC')->all();
        $query = Categories::find();
        $query->where(['parent_ID' => $parent,'status'=>'1']);
        $query->orderBy('order_id ASC');
        
        $categories = $query->all();
        if($categories && count($categories) > 0) {
            foreach($categories as $category) {
                $return[$category->CID]['CID'] = $category->CID;
                $return[$category->CID]['name'] = $category->name;
                
                $subcats = Categories::getCategoriesList($category->CID);
                if($subcats) {
                    $return[$category->CID]['subcats'] = $subcats;
                }
                
                $manuf = Categories::getManufacturesForCID($category->CID);
                if($manuf) {
                    $return[$category->CID]['manuf'] = $manuf;
                }
            }
        }
        return $return;
    }
    
    public static function getManufacturesForCID($cid) {
        $query = new Query;
        $query->select([
            'm.MID as manuf_id',                            
            'm.name as manuf_name',                            
        ]);
        $query->from([
            'products as p',
            'product_categories as pc',
            'manufactures as m',
        ]);
        $query->andWhere('`p`.`PID` = `pc`.`PID`');
        $query->andWhere('`p`.`manufacture_id` = `m`.`MID`');
        $query->andWhere("`m`.`status` = '1'");
        $query->andWhere("`p`.`status` = '1'");
        $query->andFilterWhere(['=','pc.CID',$cid]);
        
        $query->groupBy('`m`.`MID`');
        $query->orderBy('`m`.`name` ASC');
        
        $res = $query->all();
        if($res && count($res) > 0) {
            return $res;
        } else {
            return false;
        }
    }
    
    public function createCategoriesTree($parent = 0,$current_cat = null, $wrap = "li",$echo = true) {
        $return = '';
        $categs = Categories::getCategoriesList($parent);
        foreach($categs as $categ) {
            $is_active = "";
            if(isset($categ['subcats']) && in_array($current_cat,array_keys($categ['subcats']))) {
                $is_active = "selected";
            }
            $return .= "<".$wrap.' class="'.($parent == 0 ? 'luminaire-categories' : '').''.($categ['CID'] == $current_cat ? 'selected' : "").' '.$is_active.'">';
            
            if($parent == 0) {
                $return .= "<h3>";
            }
            
            if(isset($categ['CID'])) {
                if($parent !== 0) {
                    
                    $return .= '<a href="'.Yii::$app->UrlManager->createUrl(["luminaire/view",'cat'=>$categ['CID']]).'" class="categ-link">';
                }
                if(isset($categ['manuf']) && count($categ['manuf']) > 0) {
                        $return .= '<span class="subnav-trigger '.($categ['CID'] == $current_cat ? 'show' : "").'"></span>';
                    }
                $return .= $categ['name'];
                if($parent !== 0) {
                    $return .= "</a>";
                }
                
            }
            
            if($parent == 0) {
                $return .= "</h3>";
            }
            
            if(isset($categ['manuf']) && count($categ['manuf']) > 0) {
                $return .= "<ul>";
                foreach($categ['manuf'] as $manuf) {
                    $return .= '<li><a href="'.Yii::$app->urlManager->createUrl(["luminaire/view",'cat'=>$categ['CID']]).'#h3.manufacture_'.$manuf['manuf_id'].'" class="scroll-top" data-target="h3.manufacture_'.$manuf['manuf_id'].'">';
                    $return .= $manuf['manuf_name'];
                    $return .= "</a></li>";
                }
                $return .= "</ul>"; 
            }
            
            
            
            if(isset($categ['subcats'])) {
                $subcats = Categories::createCategoriesTree($categ['CID'],$current_cat,$wrap,false);
                if($subcats && count($subcats) > 0) {
                    $return .= "<ul>";
                    $return .= $subcats;
                    $return .= "</ul>";
                }
            }
            
            $return .= "</".$wrap.">";
        }
        if($echo) {
            echo $return;
        } else {
            return $return;
        }
        
    }
    
    public function generateBreadcrumbs($cid) {
        $tree = Categories::getParentCategoryTreeArray($cid);
        $tree = array_reverse($tree);
        if($tree) {
            ?>
            <ul>
                <li>WFLI</li>
            <?php
            foreach($tree as $item) {
                ?>
                <li><?=$item['name']?></li>
                <?php
            }
            ?></ul><?php
        }
        /*$model = Categories::findOne($cid);
        if($model) {
            $html .= "<li>".$model->name."</li>";
            while($parent = Categories::getParentCategory($model->CID)) {
                $html .= "<li>".$parent->name."</li>";
            }
        }
        echo $html;*/
    }
    
    public function getParentCategoryTreeArray($cid) {
        $model = Categories::findOne($cid);
        $return = [];
        if($model) {
            $return[] = [
                'CID' => $model->CID,
                'name' => $model->name
            ];
            if($model->parent_ID > 0) {
                $parent = Categories::getParentCategoryTreeArray($model->parent_ID);
                if($parent) {
                    $return[] = [
                        'CID' => $parent[0]['CID'],
                        'name' => $parent[0]['name']
                    ];
                }
                
            }
            return $return;
        } else{
            return false;
        }
        
    }
    
    public function getCategoriesForDropdown() {
        $query = Categories::find();
        $query->andWhere("`status` = '1'");
        $query->orderBy('`name` ASC');
        
        $res = $query->all();
        
        $return = [];
        if($res) {
            foreach($res as $cat) {
                $return[$cat->CID] = $cat->name;
            }
        }
        return $return;
    }
    
    public function setCategoryLastOrder($CID = false) {
        if(!$CID) {
            $CID = $this->CID;
        }
        
        $model = Categories::findOne($CID);
        if($model) {
            $last = Categories::find()->orderBy(['order_id' => SORT_DESC])->one();
            if($last) {
                $model->order_id = $last->order_id + 1;
                $model->save(false);
            }
        }
    }
    
    public function createSortCategoriesTree($parent = 0,$current_cat = null, $wrap = "li",$echo = true) {
        $return = '';
        $categs = Categories::getCategoriesList($parent);
        foreach($categs as $categ) {
            $return .= "<".$wrap.' id="item_'.$categ['CID'].'">';
            
            if(isset($categ['CID'])) {
                
                
                $return .= '<div class="handle">';
                $return .= '<a href="javascript:void(0)" class="pull-left"><span class="glyphicon glyphicon-th-list" style="margin-right:10px"></span>'.$categ['CID'].' - '.$categ['name'].'</a>';
                $return .= '<a href="'.Yii::$app->urlManager->createUrl(['categories/update','CID'=>$categ['CID']]).'" class="btn btn-sm btn-primary pull-right">Edit</a>';
                $return .= '<div class="clearfix"></div>';
                $return .= '</div>';
                                
            }
            
            if(isset($categ['subcats'])) {
                $subcats = Categories::createSortCategoriesTree($categ['CID'],$current_cat,$wrap,false);
                if($subcats && count($subcats) > 0) {
                    $return .= "<ul>";
                    $return .= $subcats;
                    $return .= "</ul>";
                }
            }
            
            $return .= "</".$wrap.">";
        }
        if($echo) {
            echo $return;
        } else {
            return $return;
        }
        
    }
}
