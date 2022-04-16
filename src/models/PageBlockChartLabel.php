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
            'title' => 'Заголовок',
            'sort' => 'Сортировочный вес',
            'block_id' => 'Блок страницы',
            'is_publish' => 'Опубликован',
            'status' => 'Статус',
            'created_at' => 'Создан',
            'updated_at' => 'Изменен',
        ];
    }

    public function getBlock()
    {
        return $this->hasOne(PageBlock::class, ['id' => 'block_id']);
    }
}
