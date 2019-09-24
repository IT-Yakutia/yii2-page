<?php

namespace uraankhayayaal\page\models;

use Yii;
use yii\behaviors\TimestampBehavior;

class PageMenu extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'page_menu';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['is_publish', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'key'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'is_publish' => 'Опубликован',
            'status' => 'Статус',
            'created_at' => 'Создан',
            'updated_at' => 'Изменен',
            'key' => 'Ключ',
        ];
    }

    public function getPageMenuItems()
    {
        return $this->hasMany(PageMenuItem::className(), ['page_menu_id' => 'id'])->orderBy(['sort' => SORT_ASC]);
    }

    public function getPageMenuRootItems()
    {
        return $this->hasMany(PageMenuItem::className(), ['page_menu_id' => 'id'])->where(['parent_id' => null])->orderBy(['sort' => SORT_ASC]);
    }
}
