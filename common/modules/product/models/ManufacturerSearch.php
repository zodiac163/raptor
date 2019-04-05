<?php

namespace common\modules\product\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\product\models\Manufacturer;

/**
 * ManufacturerSearch represents the model behind the search form of `common\modules\product\models\Manufacturer`.
 */
class ManufacturerSearch extends Manufacturer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_user_id', 'modified_user_id'], 'integer'],
            [['fullname', 'shortname', 'description', 'activity_kind', 'address', 'phone', 'site', 'mail', 'social_networks', 'branches', 'contact_person', 'logo', 'additional_files', 'language', 'created_time', 'modified_time'], 'safe'],
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
        $query = Manufacturer::find();

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
            'created_user_id' => $this->created_user_id,
            'created_time' => $this->created_time,
            'modified_user_id' => $this->modified_user_id,
            'modified_time' => $this->modified_time,
        ]);

        $query->andFilterWhere(['like', 'fullname', $this->fullname])
            ->andFilterWhere(['like', 'shortname', $this->shortname])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'activity_kind', $this->activity_kind])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'site', $this->site])
            ->andFilterWhere(['like', 'mail', $this->mail])
            ->andFilterWhere(['like', 'social_networks', $this->social_networks])
            ->andFilterWhere(['like', 'branches', $this->branches])
            ->andFilterWhere(['like', 'contact_person', $this->contact_person])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'additional_files', $this->additional_files])
            ->andFilterWhere(['like', 'language', $this->language]);

        return $dataProvider;
    }
}
