<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Finishes;

/**
 * FinishesSearch represents the model behind the search form about Finishes.
 */
class FinishesSearch extends Model
{
	public $FID;
	public $name;

	public function rules()
	{
		return [
			[['FID'], 'integer'],
			[['name'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'FID' => 'Fid',
			'name' => 'Name',
		];
	}

	public function search($params)
	{
		$query = Finishes::find();
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
            'FID' => $this->FID,
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
