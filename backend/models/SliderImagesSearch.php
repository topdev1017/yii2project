<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SliderImages;

/**
* SliderImagesSearch represents the model behind the search form about `backend\models\SliderImages`.
*/
class SliderImagesSearch extends SliderImages
{
    /**
    * @inheritdoc
    */
    public function rules()
    {
            return [
                    [['SliderImagesID', 'sliderID', 'imageID', 'orderID'], 'integer'],
                        [['link', 'content'], 'safe'],
            ];
    }

    /**
    * @inheritdoc
    */
    public function scenarios()
    {
            // bypass scenarios() implementation in the parent class
            return Model::scenarios();
    }

    /**
    * Creates data provider instance with search query applied
    *
    * @param array $params
    *
    * @return ActiveDataProvider
    */
    public function search($params)
    {
        $query = SliderImages::find();

        $dataProvider = new ActiveDataProvider([
        'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'SliderImagesID' => $this->SliderImagesID,
            'sliderID' => $this->sliderID,
            'imageID' => $this->imageID,
            'orderID' => $this->orderID,
        ]);

        $query->andFilterWhere(['like', 'link', $this->link])
        ->andFilterWhere(['like', 'content', $this->content]);
        
        $query->orderBy = (['orderID'=>'ASC']);

        return $dataProvider;
    }
}