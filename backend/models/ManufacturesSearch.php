<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Manufactures;

/**
 * ManufacturesSearch represents the model behind the search form about Manufactures.
 */
class ManufacturesSearch extends Manufactures
{
	public $MID;
	public $name;
	public $url;
	public $image;
    public $cost_range;
	public $specialized;
    public $status;
	public $tagNames;
	public $created_at;
    public $updated_at;
	public $letter;

	public function rules()
	{
		return [
			[['MID', 'status'], 'integer'],
			[['name', 'url', 'image', 'cost_range', 'created_at', 'updated_at', 'specialized', 'tagNames'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'MID' => 'Mid',
			'name' => 'Name',
			'url' => 'Url',
			'image' => 'Image',
			'cost_range' => 'Cost Range',
			'status' => 'Status',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}

	public function search($params)
	{
		$query = Manufactures::find()->with(['specialized', 'tagsNames']);
//        $query->joinWith(['specialized', 'tagsNames']);
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
            'pagination' => [
                'pageSize' => 40,
            ],
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
            'MID' => $this->MID,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

		$query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['=', 'specialized.SpID', $this->specialized])
            ->andFilterWhere(['like', 'cost_range', $this->cost_range])
            ->andFilterWhere(['like', 'tags.name', $this->tagNames]);

		return $dataProvider;
	}
    
    
    public function searchManufacturesABC($params)
    {
        $query = Manufactures::find();
        
        $query->select([
            "DISTINCT(IF(LEFT(UPPER(name),1) REGEXP '^[A-Z]+$',LEFT(UPPER(name),1),'#')) as letter",
        ]);
        
        $query->orderBy("(letter REGEXP '^[A-Z]') DESC, letter ASC");
        
        if(isset($params['cost_range'])) {
            $query->andFilterWhere([
                'cost_range' => $params['cost_range'],
            ]);
        }
        
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
        
        $query->andFilterWhere([
            'status' => '1',
        ]);

        /*if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'MID' => $this->MID,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'cost_range', $this->cost_range]);*/

        return $dataProvider;
    }
    
    public function searchManufacturesByABC($params)
    {
        $query = Manufactures::find();
//        $query->joinWith('tagsNames');
        
        if(isset($params['letter'])) {
            if($params['letter'] == "#") {
                $query->andFilterWhere(["NOT REGEXP", 'LEFT(UPPER(`manufactures`.name),1) ', '^[A-Z]+$']);
            } else {
                $query->andFilterWhere(['=', 'LEFT(UPPER(`manufactures`.name),1)', strtoupper($params['letter'])]);
            }
            
        }
        
        if(isset($params['cost_range'])) {
            $query->andFilterWhere([
                'cost_range' => $params['cost_range'],
            ]);
        }
        $query->orderBy('`manufactures`.name ASC');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);

//        if (!($this->load($params) && $this->validate())) {
//            return $dataProvider;
//        }
        $query->andFilterWhere([
            'status' => '1',
        ]);

        /*$query->andFilterWhere([
            'MID' => $this->MID,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'cost_range', $this->cost_range]);*/

        return $dataProvider;
    }
    
    public function getProductForWishlistIn($params) {
       
        $query = Manufactures::find();
        $query->joinWith("products");
        $query->select([
            "manufactures.MID",
            "manufactures.name",
        ]);
        
        if(isset($params['led'])) {
            $query->andWhere('led=1');
        }
        
        if(isset($params['quick_ship'])) {
            $query->andWhere('quick_ship=1');
        }
        
        if(!isset($params['in']) || count($params['in']) < 1 || empty($params['in'])) {
            $query->where('0=1');
        } else {
            $query->andWhere(['IN','products.PID',$params['in']]);
        }
        
        $query->groupBy("manufactures.MID");
        $query->orderBy("manufactures.name ASC");
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
        
        return $dataProvider;
    }
    
    public function searchManufacturesSpecializedByID($params) {
       
        $query = Manufactures::find();
        $query->joinWith('specialized');
        
        if(isset($params['SpID'])) {
            $query->andFilterWhere(['=','specialized.SpID',$params['SpID']]);
        }
        
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
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
