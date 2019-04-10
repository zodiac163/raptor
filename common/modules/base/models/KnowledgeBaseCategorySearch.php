<?php

namespace common\modules\base\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\base\models\KnowledgeBaseCategory;

/**
 * KnowledgeBaseCategorySearch represents the model behind the search form of `common\modules\base\models\KnowledgeBaseCategory`.
 */
class KnowledgeBaseCategorySearch extends KnowledgeBaseCategory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'level', 'published', 'created_user_id', 'modified_user_id'], 'integer'],
            [['path', 'alias', 'title', 'description', 'params', 'metadata', 'language', 'created_time', 'modified_time'], 'safe'],
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
        $query = KnowledgeBaseCategory::find();

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
        $query->where(['>','id','1'])->andFilterWhere([
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'level' => $this->level,
            'published' => $this->published,
            'created_user_id' => $this->created_user_id,
            'created_time' => $this->created_time,
            'modified_user_id' => $this->modified_user_id,
            'modified_time' => $this->modified_time,
        ]);

        $query->andFilterWhere(['like', 'path', $this->path])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'params', $this->params])
            ->andFilterWhere(['like', 'metadata', $this->metadata])
            ->andFilterWhere(['like', 'language', $this->language]);

        return $dataProvider;
    }
}
