<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Sliders;

/**
 * SlidersSearch represents the model behind the search form about Sliders.
 */
class SlidersSearch extends Model
{
	public $SliderID;
	public $name;
	public $type;
	public $video_button;
	public $description;

	public function rules()
	{
		return [
			[['SliderID'], 'integer'],
			[['name', 'type', 'video_button', 'description'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'SliderID' => 'Slider ID',
			'name' => 'Name',
			'type' => 'Type',
			'video_button' => 'Video Button',
			'description' => 'Description',
		];
	}

	public function search($params)
	{
		$query = Sliders::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
            'SliderID' => $this->SliderID,
        ]);

		$query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'video_button', $this->video_button])
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
