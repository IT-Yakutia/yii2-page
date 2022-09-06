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
    const BLOCK_WIDGET = [
        PageBlock::RAW_TEXT_TYPE => 'frontend\themes\basic\widgets\page_text\TextBlockWidget',
        PageBlock::CHART_TYPE => 'frontend\themes\basic\widgets\page_chart\ChartBlockWidget',
        PageBlock::GALLERY_TYPE => 'frontend\themes\basic\widgets\page_gallery\GalleryBlockWidget',
        PageBlock::FAQ_TYPE => 'frontend\themes\basic\widgets\page_faq\FaqBlockWidget',
        PageBlock::IMAGE_TEXT_TYPE => 'frontend\themes\basic\widgets\page_img_block\ImgBlockWidget',
    ];

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
            [['title'], 'required'],
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
            'title' => 'Заголовок',
            'content' => 'Содержание',
            'photo' => 'Иконка',
            'sort' => 'Сортировочный вес',
            'no_title' => 'Не показывать заголовок',
            'slug' => 'Slug',
            'user_id' => 'Автор',
            'is_publish' => 'Опубликовать',
            'status' => 'Статус',
            'created_at' => 'Создан',
            'updated_at' => 'Изменен',
        ];
    }

    public static function findOneForFront($slug)
    {
        if (Yii::$app->user->can("page"))
            return self::find()->where(['slug' => $slug])->one();
        else
            return self::find()->where(['slug' => $slug, 'is_publish' => true])->one();
    }

    public function getPageMenuItems()
    {
        return $this->hasMany(PageMenuItem::className(), ['page_id' => 'id']);
    }

    public function getPageBlocks()
    {
        return $this->hasMany(PageBlock::class, ['page_id' => 'id']);
    }

    public function getBlocks()
    {
        $page = $this->getPageBlocks()->orderBy(['sort' => SORT_ASC])->all();
        if (empty($page)) {
            return [];
        }

        $blocks = [];
        foreach ($page as $block) {

            if (!$block->is_publish) {
                continue;
            }

            if ($block->type === PageBlock::RAW_TEXT_TYPE) {
                $blocks[] = $this->renderRawBlock($block);
            }

            if ($block->type === PageBlock::IMAGE_TEXT_TYPE) {
                $blocks[] = $this->renderImageTextBlock($block);
            }

            if ($block->type === PageBlock::FAQ_TYPE) {
                $blocks[] = $this->renderFaqBlock($block);
            }

            if ($block->type === PageBlock::GALLERY_TYPE) {
                $blocks[] = $this->renderGalleryBlock($block);
            }

            if ($block->type === PageBlock::CHART_TYPE) {
                $blocks[] = $this->renderChartBlock($block);
            }
        }

        return $blocks;
    }

    private function renderRawBlock($block)
    {
        $data = [
            'title' => $block->title ?? '',
            'content' => $block->content ?? ''
        ];

        return self::render($block->type, $data);
    }

    private function renderImageTextBlock($block)
    {
        $data = [
            'title' => $block->title ?? '',
            'content' => $block->content ?? '',
            'photo' => $block->photo ?? ''
        ];

        return self::render($block->type, $data);
    }

    private function renderFaqBlock($block)
    {
        $data['title'] = $block->title ?? '';

        $block_faq = $block->getPageBlockFaq()->all();

        $data['items'] = [];
        if (!empty($block_faq)) {
            foreach ($block_faq as $item) {

                if (!$item->is_publish) {
                    continue;
                }

                $data['items'][] = [
                    'label' => $item->title ?? '',
                    'content' => $item->content ?? '',
                    'contentOptions' => []
                ];
            }
        }

        return self::render($block->type, $data);
    }

    private function renderGalleryBlock($block)
    {
        $data['title'] = $block->title ?? '';

        $block_gallery = $block->getGalleryPageBlocks()->all();

        $data['items'] = [];
        if (!empty($block_gallery)) {
            foreach ($block_gallery as $item) {
                $photos = $item->getPhoto()->all();
                if (!empty($photos)) {
                    foreach ($photos as $photo) {
                        $image = '<a class="fancybox" data-fancybox-group="gallery'.$block->id.'" href="' . $photo->original . '" title="'.$data['title'].'" alt="'.$data['title'].'"><img class="w-100" src="' . $photo->original . '" alt="gallery image"></a>';
                        $name = $photo->name;
                        $text = $photo->description;
                        $data['items'][] =
                            [
                                'content' => $image,
                                'caption' => '<h4>' . $name . '</h4><p>' . $text . '</p>',
                                'captionOptions' => ['class' => ['d-none', 'd-md-block']],
                                'options' => [],
                            ];
                    }
                }
            }
        }

        return self::render($block->type, $data);
    }

    private function renderChartBlock($block)
    {
        $data['title'] = $block->title;
        $data['data'] = $block->getCharts();

        return self::render($block->type, $data);
    }

    private static function render($type, $data)
    {
        $class = PageBlock::BLOCK_WIDGET[$type];
        return $class::widget(['data' => $data]);
    }
}
