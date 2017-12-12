<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Sizes;

/**
 * SizesSearch represents the model behind the search form about Sizes.
 */
class SizesSearch extends Model
{
	public $SID;
	public $name;

	public function rules()
	{
		return [
			[['SID'], 'integer'],
			[['name'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'SID' => 'Sid',
			'name' => 'Name',
		];
	}

	public function search($params)
	{
		$query = Sizes::find();
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
            'SID' => $this->SID,
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
