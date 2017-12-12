<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Categories;

/**
 * ProductsCategories represents the model behind the search form about Categories.
 */
class ProductsCategories extends Model
{
	public $CID;
	public $parent_ID;
	public $name;
	public $slug;
	public $description;
	public $status;
	public $created_at;
	public $updated_at;

	public function rules()
	{
		return [
			[['CID', 'parent_ID', 'status'], 'integer'],
			[['name', 'slug', 'description', 'created_at', 'updated_at'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'CID' => 'Cid',
			'parent_ID' => 'Parent  ID',
			'name' => 'Name',
			'slug' => 'Slug',
			'description' => 'Description',
			'status' => 'Status',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}

	public function search($params)
	{
		$query = Categories::find();
		$query->orderBy('order_id ASC');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
//            'pagination' => false
        ]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
            'CID' => $this->CID,
            'parent_ID' => $this->parent_ID,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

		$query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'description', $this->description]);

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
