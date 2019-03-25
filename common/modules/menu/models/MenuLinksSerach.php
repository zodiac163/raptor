<?php

namespace common\modules\menu\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\menu\models\MenuLinks;

/**
 * MenuLinksSerach represents the model behind the search form of `common\modules\menu\models\MenuLinks`.
 */
class MenuLinksSerach extends MenuLinks
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'menu_id', 'parent_id', 'published', 'created_user_id', 'modified_user_id'], 'integer'],
            [['title', 'link', 'language', 'created_time', 'modified_time'], 'safe'],
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
        $query = MenuLinks::find();

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
            'menu_id' => $this->menu_id,
            'parent_id' => $this->parent_id,
            'published' => $this->published,
            'created_user_id' => $this->created_user_id,
            'created_time' => $this->created_time,
            'modified_user_id' => $this->modified_user_id,
            'modified_time' => $this->modified_time,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'language', $this->language]);

        return $dataProvider;
    }
}
