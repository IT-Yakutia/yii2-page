<?php

namespace uraankhayayaal\page\models;

use uraankhayayaal\sortable\behaviors\Sortable;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class PageBlockChartLabel extends ActiveRecord
{
    public static function tableName()
    {
        return 'page_block_chart_label';
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
            [['title'], 'required'],
            [['sort', 'block_id', 'is_publish', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'sort' => 'Sort',
            'block_id' => 'Block ID',
            'is_publish' => 'Is Publish',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getBlock()
    {
        return $this->hasOne(PageBlock::class, ['id' => 'block_id']);
    }
}
