<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Specialized;

/**
 * SpecializedSearch represents the model behind the search form about Specialized.
 */
class SpecializedSearch extends Model
{
	public $SpID;
	public $name;
	public $status;
	public $created_at;
	public $updated_at;

	public function rules()
	{
		return [
			[['SpID', 'status'], 'integer'],
			[['name', 'created_at', 'updated_at'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'SpID' => 'Sp ID',
			'name' => 'Name',
			'status' => 'Status',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}

	public function search($params)
	{
		$query = Specialized::find();
        
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
            'SpID' => $this->SpID,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

		$query->andFilterWhere(['like', 'name', $this->name]);

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
