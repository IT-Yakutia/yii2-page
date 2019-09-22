<?php

namespace uraankhayayaal\page\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "page".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $photo
 * @property int $sort
 * @property int $no_title
 * @property string $slug
 * @property int $user_id
 * @property int $is_publish
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'sortable' => [
                'class' => \uraankhayayaal\sortable\behaviors\Sortable::className(),
                'query' => self::find(),
            ],
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => 'user_id',
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => 'user_id',
                ],
                'value' => function ($event) {
                    return Yii::$app->user->id;
                },
            ],
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'slug',
                'immutable' => true,
                'ensureUnique' => true,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'user_id'], 'required'],
            [['content'], 'string'],
            [['sort', 'no_title', 'user_id', 'is_publish', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'photo', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'photo' => 'Photo',
            'sort' => 'Sort',
            'no_title' => 'No Title',
            'slug' => 'Slug',
            'user_id' => 'User ID',
            'is_publish' => 'Is Publish',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function findOneForFront($slug)
    {
        if(Yii::$app->user->can("page"))
            return self::find()->where(['slug' => $slug])->one();
        else
            return self::find()->where(['slug' => $slug, 'is_publish' => true])->one();
    }
}
