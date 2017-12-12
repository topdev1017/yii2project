<?php 
namespace backend\models;

use Yii;
use yii\db\Query;
use yii\data\ActiveDataProvider;

use backend\models\Categories;
use backend\models\Manufactures;
use backend\models\Products;
use backend\models\ProductCategories;

class CategoriesSearch extends Categories
{
    public static function searchManufacturesForCID($params) {
//        print_r($params);
        $query = new Query();
        $query->select([
            'm.MID',
            'm.name',
        ]);
        $query->from([
            'products as p',
            'product_categories as pc',
            'categories as c',
            'manufactures as m',
        ]);
        
        $query->andWhere('pc.PID = p.PID');
        $query->andWhere('p.manufacture_id = m.MID');
        $query->andWhere('p.status = 1');
        $query->andWhere('m.status = 1');
        
        $query->andWhere('pc.CID = :cid',[':cid'=>$params['CID']]);
        
        
        
        $query->groupBy('p.manufacture_id');
        $query->orderBy("m.name ASC");
        
        $command = $query->createCommand();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
        
        return $dataProvider;
        
        
    }
}
?>