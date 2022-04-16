<?php 

namespace uraankhayayaal\page\models;

use yii\db\ActiveRecord;
use uraankhayayaal\sortable\behaviors\Sortable;
use yii\behaviors\TimestampBehavior;

class PageBlockFaq extends ActiveRecord
{
    public static function tableName()
    {
        return 'page_block_faq';
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
            [['content'], 'string'],
            [['sort', 'block_id', 'is_publish', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Вопрос',
            'content' => 'Ответ',
            'block_id' => 'Блок страницы',
            
            'sort' => 'Сортировочный вес',
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
}