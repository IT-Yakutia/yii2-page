<?php

namespace uraankhayayaal\page\models;

use uraankhayayaal\sortable\behaviors\Sortable;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class PageBlockChartParam extends ActiveRecord
{
    public static function tableName()
    {
        return 'page_block_chart_param';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            'sortable' => [
                'class' => Sortable::class,
                'query' => self::find(),
            ],
        ];
    }

    public function rules()
    {
        return [
            [['title', 'value', 'color'], 'required'],
            [['sort', 'chart_id', 'is_publish', 'status', 'created_at', 'updated_at'], 'integer'],
            [['value'], 'number'],
            [['title', 'color'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'sort' => 'Sort',
            'chart_id' => 'Chart ID',
            'is_publish' => 'Is Publish',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getChart()
    {
        return $this->hasOne(PageBlockChart::class, ['id' => 'chart_id']);
    }
}
