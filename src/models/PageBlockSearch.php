<?php

namespace uraankhayayaal\page\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class PageBlockSearch extends PageBlock
{
    public function rules()
    {
        return [
            [['id', 'sort', 'type', 'page_id', 'is_publish', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'content', 'photo'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = PageBlock::find();
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

        $query->andFilterWhere([
            'id' => $this->id,
            'sort' => $this->sort,
            'type' => $this->type,
            'page_id' => $this->page_id,
            'is_publish' => $this->is_publish,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'photo', $this->photo]);

        // todo add queries

        return $dataProvider;
    }
}
