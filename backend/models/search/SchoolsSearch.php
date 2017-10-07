<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Schools;

/**
 * SchoolsSearch represents the model behind the search form about `common\models\Schools`.
 */
class SchoolsSearch extends Schools

{
    public $type_id;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'active', 'type_id', 'age'], 'integer'],
            [['name', 'url', 'address', 'timetable', 'phone', 'city', 'www', 'email', 'updated', 'general_image', 'title', 'description', 'h1', 'about'], 'safe'],
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
        $query = Schools::find()->with(['types'])->joinWith(['schoolsTypes'], false)->groupBy('id');

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
            'active' => $this->active,
            'age' => $this->age,
            'updated' => $this->updated,
            '{{%schools_types}}.type_id' => $this->type_id,

        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'timetable', $this->timetable])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'www', $this->www])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'general_image', $this->general_image])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'h1', $this->h1])
            ->andFilterWhere(['like', 'about', $this->about]);

        return $dataProvider; 
    }
}
