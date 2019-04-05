<?php

namespace common\modules\product\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\product\models\Product;

/**
 * ProductSearch represents the model behind the search form of `common\modules\product\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'manufacturer_id', 'category_id', 'featured', 'ordering', 'published', 'hits', 'created_user_id', 'modified_user_id'], 'integer'],
            [['title', 'description', 'alias', 'images', 'metadata', 'manufacturer_link', 'video_link', 'code', 'specifications', 'additional_equipment', 'created_time', 'modified_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'manufacturer_id' => $this->manufacturer_id,
            'category_id' => $this->category_id,
            'featured' => $this->featured,
            'ordering' => $this->ordering,
            'published' => $this->published,
            'hits' => $this->hits,
            'created_user_id' => $this->created_user_id,
            'created_time' => $this->created_time,
            'modified_user_id' => $this->modified_user_id,
            'modified_time' => $this->modified_time,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'images', $this->images])
            ->andFilterWhere(['like', 'metadata', $this->metadata])
            ->andFilterWhere(['like', 'manufacturer_link', $this->manufacturer_link])
            ->andFilterWhere(['like', 'video_link', $this->video_link])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'specifications', $this->specifications])
            ->andFilterWhere(['like', 'additional_equipment', $this->additional_equipment]);

        return $dataProvider;
    }
}
