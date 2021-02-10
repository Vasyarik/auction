<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Lot;

/**
 * LotSearch represents the model behind the search form of `app\modules\admin\models\Lot`.
 */
class LotSearch extends Lot
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_auction', 'id_category', 'quantity', 'start_bet', 'winner', 'win_bet', 'pay_status'], 'integer'],
            [['lot_name', 'description', 'lot_img'], 'safe'],
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
        $query = Lot::find();

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
            'id_auction' => $this->id_auction,
            'id_category' => $this->id_category,
            'quantity' => $this->quantity,
            'start_bet' => $this->start_bet,
            'winner' => $this->winner,
            'win_bet' => $this->win_bet,
            'pay_status' => $this->pay_status,
        ]);

        $query->andFilterWhere(['like', 'lot_name', $this->lot_name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'lot_img', $this->lot_img]);

        return $dataProvider;
    }
}
