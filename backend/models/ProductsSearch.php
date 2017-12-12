<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Products;

/**
 * ProductsSearch represents the model behind the search form about Products.
 */
class ProductsSearch extends Model
{
	public $PID;
	public $name;
	public $description;
	public $manufacture_product_url;
	public $slug;
	public $image;
    public $category;
    public $sizes;
    public $finishes;
    public $manufacture_id;
	public $cost_range;
	public $status;
	public $created_at;
    public $updated_at;

	public function rules()
	{
		return [
			[['PID', 'manufacture_id', 'status'], 'integer'],
			[['name', 'description', 'manufacture_product_url', 'slug', 'image', 'created_at', 'updated_at','category', 'sizes', 'finishes', 'cost_range'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'PID' => 'Pid',
			'name' => 'Name',
			'description' => 'Description',
			'manufacture_product_url' => 'Manufacture Product Url',
			'slug' => 'Slug',
			'image' => 'Image',
			'manufacture_id' => 'Manufacture ID',
			'status' => 'Status',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}

	public function search($params)
	{
        $db= \Yii::$app->db;
        $db->createCommand('SET SQL_BIG_SELECTS=1')->execute();
        $join_with = [];
//            print_r($params);
            if(isset($params['ProductsSearch']['category'])){
                echo 'category';
               $join_with[] = 'category'; 
            }
            if(isset($params['ProductsSearch']['sizes'])){
               $join_with[] = 'size'; 
            }
            if(isset($params['ProductsSearch']['finish'])){
               $join_with[] = 'finish'; 
            }
//            print_R($join_with);die();
         if(count($join_with)>0){
//             echo 'aaa';
            $query = Products::find()->joinWith($join_with); 
         }else{
             $query = Products::find();
         } 
         
//        print_r($params);die();
//		$query = Products::find()->joinWith(['manufacture','category','size','finish']);
//        $query->joinWith(['manufacture','category','size','finish']);
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
            'products.PID' => $this->PID,
            'products.manufacture_id' => $this->manufacture_id,
            'products.status' => $this->status,
            'products.created_at' => $this->created_at,
            'products.updated_at' => $this->updated_at,
        ]);

		$query->andFilterWhere(['like', 'products.name', $this->name])
            ->andFilterWhere(['like', 'products.description', $this->description])
            ->andFilterWhere(['like', 'products.manufacture_product_url', $this->manufacture_product_url])
            ->andFilterWhere(['like', 'products.slug', $this->slug])
            ->andFilterWhere(['like', 'products.image', $this->image])
            ->andFilterWhere(['like', 'products.manufacture_id', $this->manufacture_id])
            ->andFilterWhere(['like', 'products.cost_range', $this->cost_range])
            ->andFilterWhere(['=', 'categories.CID', $this->category])
            ->andFilterWhere(['=', 'sizes.SID', $this->sizes])
            ->andFilterWhere(['=', 'finishes.FID', $this->finishes]);

           // echo "<pre>";
//            print_r($query);
//            echo "</pre>";
		return $dataProvider;
	}
    
    public function searchProductsByManufactureID($params) {
       
        $query = Products::find();
        $query->joinWith("productCategories");
        $query->andWhere('products.manufacture_id = :manid',[':manid' => $params['MID']]);
        
        if(isset($params['CID'])) {
            $query->andWhere('product_categories.CID = :pc',[':pc' => $params['CID']]);
        }
        
        $query->andWhere('products.status = 1');
        
        if(isset($params['led'])) {
            $query->andWhere('led=1');
        }
        
        if(isset($params['quick_ship'])) {
            $query->andWhere('quick_ship=1');
        }
        if(isset($params['in'])) {
            $query->andWhere(['IN','products.PID',$params['in']]);
        }
        $query->orderBy("name ASC");
        
        $command = $query->createCommand();
//        echo "<pre>";
//        print_r($command->rawSql);
//        echo "</pre>";
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ]
        ]);
        
        return $dataProvider;
    }
    
    

	protected function addCondition($query, $attribute, $partialMatch = false)
	{
		$value = $this->$attribute;
		if (trim($value) === '') {
			return;
		}
		if ($partialMatch) {
			$value = '%' . strtr($value, ['%'=>'\%', '_'=>'\_', '\\'=>'\\\\']) . '%';
			$query->andWhere(['like', $attribute, $value]);
		} else {
			$query->andWhere([$attribute => $value]);
		}
	}
}
