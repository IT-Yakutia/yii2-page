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
            'title' => 'Title',
            'content' => 'Content',
            'block_id' => 'Page Block ID',
            
            'sort' => 'Sort',
            'is_publish' => 'Is Publish',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}