<?php

namespace uraankhayayaal\page\models;

use ityakutia\gallery\models\GalleryPageBlock;
use uraankhayayaal\sortable\behaviors\Sortable;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "page_block"
 * 
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $photo
 * @property int $sort
 * @property int $page_id
 * @property int $is_publish
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * 
 * @property GalleryPageBlock[] $galleryPageBlocks
 */
class PageBlock extends ActiveRecord
{
    const RAW_TEXT_TYPE = 0;
    const CHART_TYPE = 1;
    const GALLERY_TYPE = 2;
    const FAQ_TYPE = 3;
    const IMAGE_TEXT_TYPE = 4;

    const TYPES = [
        'raw_text' => self::RAW_TEXT_TYPE,
        'chart' => self::CHART_TYPE,
        'gallery' => self::GALLERY_TYPE,
        'faq' => self::FAQ_TYPE,
        'image_text' => self::IMAGE_TEXT_TYPE,
    ];

    const TYPE_NAMES = [
        self::RAW_TEXT_TYPE => 'Блок текста',
        self::CHART_TYPE => 'Блок графиков',
        self::GALLERY_TYPE => 'Блок галереи',
        self::FAQ_TYPE => 'Блок FAQ',
        self::IMAGE_TEXT_TYPE => 'Блок текста с изображением',
    ];

    const BLOCK_WIDGET = [
        self::RAW_TEXT_TYPE => 'frontend\themes\basic\widgets\page_text\TextBlockWidget',
        self::CHART_TYPE => 'frontend\themes\basic\widgets\page_chart\ChartBlockWidget',
        self::GALLERY_TYPE => 'frontend\themes\basic\widgets\page_gallery\GalleryBlockWidget',
        self::FAQ_TYPE => 'frontend\themes\basic\widgets\page_faq\FaqBlockWidget',
        self::IMAGE_TEXT_TYPE => 'frontend\themes\basic\widgets\page_img_block\ImgBlockWidget',
    ];

    public static function tableName()
    {
        return 'page_block';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            'sortable' => [
                'class' => Sortable::class,
                'query' => self::find()
            ]
        ];
    }

    public function rules()
    {
        return [
            [['type'], 'required'],
            [['content'], 'string'],
            [['sort', 'page_id', 'is_publish', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'photo'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'photo' => 'Photo',
            'sort' => 'Sort',
            'page_id' => 'Page ID',
            'is_publish' => 'Is Publish',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

        /**
     * @return ActiveQuery
     */
    public function getGalleryPageBlocks()
    {
        return $this->hasMany(GalleryPageBlock::class, ['block_id' => 'id']);
    }

    public function getPageBlockFaq()
    {
        return $this->hasMany(PageBlockFaq::class, ['block_id' => 'id']);
    }
}
