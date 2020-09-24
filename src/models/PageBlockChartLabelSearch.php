<?php

namespace uraankhayayaal\page\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class PageBlockChartLabelSearch extends PageBlockChartLabel
{
    public function rules()
    {
        return [
            [['id', 'sort', 'block_id', 'is_publish', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'safe']
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params, $block_id)
    {
        $query = PageBlockChartLabel::find()->where(['block_id' => $block_id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['sort' => SORT_ASC]],
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
            'sort' => $this->sort,
            'block_id' => $this->block_id,
            'is_publish' => $this->is_publish,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
