<?php

namespace uraankhayayaal\page\models;

use uraankhayayaal\sortable\behaviors\Sortable;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class PageBlockChart extends ActiveRecord
{
    const BAR = 0;
    const PIE = 1;
    const LINE = 2;

    const TYPES = [
        'bar' => self::BAR,
        'pie' => self::PIE,
        'line' => self::LINE,
    ];

    const TYPE_NAMES = [
        self::BAR => 'Колонки',
        self::PIE => 'Пирог',
        self::LINE => 'Линейный',
    ];

    public static function tableName()
    {
        return 'page_block_chart';
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
            [['sort', 'block_id', 'is_publish', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'value' => 'Value',
            'color' => 'Color',
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

    public function getParams()
    {
        return $this->hasMany(PageBlockChartParam::class, ['chart_id' => 'id']);
    }
}