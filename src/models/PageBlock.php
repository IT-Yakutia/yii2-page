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
        self::RAW_TEXT_TYPE => 'uraankhayayaal\page\widgets\page_text\TextBlockWidget',
        self::CHART_TYPE => 'uraankhayayaal\page\widgets\page_chart\ChartBlockWidget',
        self::GALLERY_TYPE => 'uraankhayayaal\page\widgets\page_gallery\GalleryBlockWidget',
        self::FAQ_TYPE => 'uraankhayayaal\page\widgets\page_faq\FaqBlockWidget',
        self::IMAGE_TEXT_TYPE => 'uraankhayayaal\page\widgets\page_img_block\ImgBlockWidget',
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
            [['sort', 'page_id', 'chart_type', 'is_publish', 'status', 'created_at', 'updated_at'], 'integer'],
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
            'chart_type' => 'Chart Type',
            'is_publish' => 'Is Publish',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getPage()
    {
        return $this->hasOne(Page::class, ['id' => 'page_id']);
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

    public function getPageBlockChartLabels()
    {
        return $this->hasMany(PageBlockChartLabel::class, ['block_id' => 'id']);
    }

    public function getCharts($publish = false)
    {
        $charts = $this->hasMany(PageBlockChart::class, ['block_id' => 'id'])->where(['is_publish' => 1])->all();

        switch ($this->chart_type) {
            case (PageBlockChart::PIE):
                return $this->getPieChartsData($charts);
            case (PageBlockChart::BAR):
                return $this->getBarChartsData($charts);
            case (PageBlockChart::LINE):
                return $this->getLineCharsData($charts);
            default:
                return ['type' => 'bar'];
        }
    }

    private function getPieChartsData($charts)
    {
        $data = [
            'type' => 'pie',
            'id' => 'structurePie',
            'options' => [
                'height' => 200,
                'width' => 400,
            ],
            'data' => [
                'radius' =>  "90%",
                'labels' => [],
                'datasets' => []
            ],
        ];

        $labels = [];
        $datasets = [];
        if (!empty($charts)) {
            foreach ($charts as $chart) {
                $labels[] = $chart->title;
                $datasets[0]['data'][] = $chart->value;
                $datasets[0]['backgroundColor'][] = $chart->color;
                $datasets[0]['borderColor'][] = $chart->color;
            }
        }

        $data['data']['labels'] = $labels;
        $data['data']['datasets'] = $datasets;

        return $data;
    }

    private function getBarChartsData($charts)
    {
        $data = [
            'type' => 'bar',
            'data' => [
                'labels' => [''],
                'datasets' => []
            ],
        ];

        $max = 0;
        $datasets = [];
        if (!empty($charts)) {
            foreach ($charts as $chart) {
                if ($max < $chart->value) {
                    $max = $chart->value;
                }

                $set = [];
                $set['data'][] = $chart->value;
                $set['backgroundColor'][] = $chart->color;
                $set['borderColor'][] = "$chart->color";
                $set['label'] = $chart->title;
                $datasets[] = $set;
            }
        }
        $data['data']['datasets'] = $datasets;

        $max = str_split((string)$max);

        if (isset($max[1]) && $max[1] < 5) {
            foreach ($max as $key => $num) {
                if ($key === 0) {
                    continue;
                } elseif ($key === 1) {
                    $max[$key] = 5;
                } else {
                    $max[$key] = 0;
                }
            }
        } else {
            foreach ($max as $key => $num) {
                $max[$key] = $key === 0 ? $num + 1 : 0;
            }
        }

        $max = (int)implode('', $max);

        $options = [
            'scales' => [
                'yAxes' => [[
                    'display' => true,
                    'ticks' => [
                        'beginAtZero' => true,
                        'max' => $max,
                        'min' => 0
                    ]
                ]]
            ],
        ];

        $data['options'] = $options;

        return $data;
    }

    private function getLineCharsData($charts)
    {
        $data = [
            'type' => 'line',
            'options' => [
                'height' => 200,
                'width' => 400
            ]
        ];

        $labels = [];
        $chart_lables = $this->pageBlockChartLabels;
        foreach ($chart_lables as $label) {
            if ($label->is_publish === 1) {
                $labels[] = $label->title;
            }
        }

        $datasets = [];
        if (!empty($charts)) {
            foreach ($charts as $chart) {
                $set = [];
                $set['label'] = $chart->title;
                $set['borderColor'][] = $chart->color;

                $params = [];
                $chart_params = $chart->params;
                foreach ($chart_params as $param) {
                    foreach ($labels as $label) {
                        if ($label === $param->title) {
                            $params[] = $param->value;
                        }
                    }
                }
                $set['data'] = $params;
                $datasets[] = $set;
            }
        }
        $data['data']['labels'] = $labels;
        $data['data']['datasets'] = $datasets;

        return $data;
    }
}
