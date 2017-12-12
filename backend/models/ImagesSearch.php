<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Images;

/**
 * ImagesSearch represents the model behind the search form about Images.
 */
class ImagesSearch extends Model
{
	public $ImgID;
	public $file;
	public $embed;
	public $caption;
	public $type;

	public function rules()
	{
		return [
			[['ImgID'], 'integer'],
			[['file', 'embed', 'caption', 'type'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'ImgID' => 'Img ID',
			'file' => 'File',
			'embed' => 'Embed',
			'caption' => 'Caption',
			'type' => 'Type',
		];
	}

	public function search($params)
	{
		$query = Images::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
            'ImgID' => $this->ImgID,
        ]);

		$query->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'embed', $this->embed])
            ->andFilterWhere(['like', 'caption', $this->caption])
            ->andFilterWhere(['like', 'type', $this->type]);
        
        $query->order("ImgID DESC");

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
