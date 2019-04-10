<?php

namespace common\modules\base\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\base\models\KnowledgeBase;

/**
 * KnowledgeBaseSearch represents the model behind the search form of `common\modules\base\models\KnowledgeBase`.
 */
class KnowledgeBaseSearch extends KnowledgeBase
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cat_id', 'featured', 'ordering', 'published', 'hits', 'created_user_id', 'modified_user_id'], 'integer'],
            [['title', 'path', 'introtext', 'fulltext', 'images', 'metadata', 'language', 'created_time', 'modified_time'], 'safe'],
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
        $query = KnowledgeBase::find();

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
            'cat_id' => $this->cat_id,
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
            ->andFilterWhere(['like', 'path', $this->path])
            ->andFilterWhere(['like', 'introtext', $this->introtext])
            ->andFilterWhere(['like', 'fulltext', $this->fulltext])
            ->andFilterWhere(['like', 'images', $this->images])
            ->andFilterWhere(['like', 'metadata', $this->metadata])
            ->andFilterWhere(['like', 'language', $this->language]);

        return $dataProvider;
    }
}
