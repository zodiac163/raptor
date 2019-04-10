<?php

namespace common\modules\base\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\base\models\Journal;

/**
 * JournalSearch represents the model behind the search form of `common\modules\base\models\Journal`.
 */
class JournalSearch extends Journal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'hits', 'created_user_id', 'modified_user_id'], 'integer'],
            [['title', 'date', 'image', 'description', 'language', 'created_time', 'modified_time'], 'safe'],
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
        $query = Journal::find();

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
            'date' => $this->date,
            'hits' => $this->hits,
            'created_user_id' => $this->created_user_id,
            'created_time' => $this->created_time,
            'modified_user_id' => $this->modified_user_id,
            'modified_time' => $this->modified_time,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'language', $this->language]);

        return $dataProvider;
    }
}
