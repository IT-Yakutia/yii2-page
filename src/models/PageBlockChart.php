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
            'title' => 'Заголовок',
            'value' => 'Значение',
            'color' => 'Цвет',
            'sort' => 'Сортировочный вес',
            'block_id' => 'Блок страницы',
            'is_publish' => 'Опубликовать',
            'status' => 'Статус',
            'created_at' => 'Создан',
            'updated_at' => 'Изменен',
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