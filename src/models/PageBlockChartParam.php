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
            [['title', 'value'], 'required'],
            [['sort', 'chart_id', 'is_publish', 'status', 'created_at', 'updated_at'], 'integer'],
            [['value'], 'number'],
            [['title', 'color'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'sort' => 'Сортировочный вес',
            'chart_id' => 'График',
            'is_publish' => 'Опубликовать',
            'status' => 'Статус',
            'created_at' => 'Создан',
            'updated_at' => 'Изменен',
        ];
    }

    public function getChart()
    {
        return $this->hasOne(PageBlockChart::class, ['id' => 'chart_id']);
    }
}
