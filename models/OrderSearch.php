<?php

namespace app\Models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\Models\Order;
use \yii\data\Sort;

/**
 * OrderSearch represents the model behind the search form about `app\Models\Order`.
 */
class OrderSearch extends Order {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['id', 'user_id', 'delivery_type'], 'integer'],
                [['name', 'phone', 'email', 'zipcode', 'city', 'street', 'house', 'build', 'room', 'order_number'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Order::find();

        $sort = new Sort([
            'defaultOrder' => [
                'id' => SORT_DESC,
            ]
        ]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => $sort,
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
            'user_id' => $this->user_id,
            'delivery_type' => $this->delivery_type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
        ->andFilterWhere(['like', 'phone', $this->phone])
        ->andFilterWhere(['like', 'email', $this->email])
        ->andFilterWhere(['like', 'zipcode', $this->zipcode])
        ->andFilterWhere(['like', 'city', $this->city])
        ->andFilterWhere(['like', 'street', $this->street])
        ->andFilterWhere(['like', 'house', $this->house])
        ->andFilterWhere(['like', 'build', $this->build])
        ->andFilterWhere(['like', 'room', $this->room])
        ->andFilterWhere(['like', 'order_number', $this->order_number]);

        return $dataProvider;
    }

}
