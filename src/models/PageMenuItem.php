<?php

namespace uraankhayayaal\page\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use uraankhayayaal\sortable\behaviors\Sortable;

class PageMenuItem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'page_menu_item';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'sortable' => [
                'class' => Sortable::className(),
                'query' => self::find(),
            ],
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => 'user_id',
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => 'user_id',
                ],
                'value' => function ($event) {
                    return (Yii::$app instanceof \yii\console\Application) ? 1 : Yii::$app->user->id;
                },
            ],
        ];
    }

    public function rules()
    {
        return [
            [['name', 'page_menu_id'], 'required'],
            [['user_id', 'page_menu_id', 'page_id', 'sort', 'is_publish', 'status', 'created_at', 'updated_at', 'parent_id'], 'integer'],
            [['name', 'url'], 'string', 'max' => 255],
            //[['url'], 'url'],
            [['page_id'], 'exist', 'skipOnError' => true, 'targetClass' => Page::className(), 'targetAttribute' => ['page_id' => 'id']],
            [['page_menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => PageMenu::className(), 'targetAttribute' => ['page_menu_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => PageMenuItem::className(), 'targetAttribute' => ['parent_id' => 'id']],
            ['page_id', 'unique'],
            [['url', 'page_id'], \uraankhayayaal\page\components\EitherValidator::className()],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'url' => 'Ссылка',
            'user_id' => 'Автор',
            'page_menu_id' => 'Меню',
            'page_id' => 'Страница',
            'sort' => 'Sort',
            'is_publish' => 'Опубликовать',
            'status' => 'Статус',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
            'parent_id' => 'Родительский элемент',
        ];
    }

    public function getPage()
    {
        return $this->hasOne(Page::className(), ['id' => 'page_id']);
    }

    public function getPageMenu()
    {
        return $this->hasOne(PageMenu::className(), ['id' => 'page_menu_id']);
    }

    public function getParent()
    {
        return $this->hasOne(PageMenuItem::className(), ['id' => 'parent_id']);
    }

    public function getPageMenuItems()
    {
        return $this->hasMany(PageMenuItem::className(), ['parent_id' => 'id'])->orderBy(['sort' => SORT_ASC]);
    }
}
