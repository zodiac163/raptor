<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Settings;

/**
 * SettingsSearch represents the model behind the search form of `common\models\Settings`.
 */
class SettingsSearch extends Settings
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sys_state'], 'integer'],
            [['sys_title', 'sys_slogan', 'sys_description', 'sys_logo', 'sys_footer', 'adm_mail', 'seo_description', 'seo_keywords'], 'safe'],
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
        $query = Settings::find();

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
            'sys_state' => $this->sys_state,
        ]);

        $query->andFilterWhere(['like', 'sys_title', $this->sys_title])
            ->andFilterWhere(['like', 'sys_slogan', $this->sys_slogan])
            ->andFilterWhere(['like', 'sys_description', $this->sys_description])
            ->andFilterWhere(['like', 'sys_logo', $this->sys_logo])
            ->andFilterWhere(['like', 'sys_footer', $this->sys_footer])
            ->andFilterWhere(['like', 'adm_mail', $this->adm_mail])
            ->andFilterWhere(['like', 'seo_description', $this->seo_description])
            ->andFilterWhere(['like', 'seo_keywords', $this->seo_keywords]);

        return $dataProvider;
    }
}
