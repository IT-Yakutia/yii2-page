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
            'title' => 'Заголовок',
            'content' => 'Содержание',
            'photo' => 'Фото',
            'sort' => 'Сортироваочный вес',
            'page_id' => 'Страница',
            'chart_type' => 'Тип графика',
            'is_publish' => 'Опубликовать',
            'status' => 'Статус',
            'created_at' => 'Создан',
            'updated_at' => 'Изменен',
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
                $set['backgroundColor'][] = $this->hex2rgba($chart->color, 0.5);
                $set['borderColor'][] = "$chart->color";
                $set['borderWidth'][] = 1;
                $set['label'] = $chart->title;
                $datasets[] = $set;
            }
        }
        $data['data']['datasets'] = $datasets;

        $precision = count(str_split((string)$max)) - 2;
        if($precision <= 0) {
            $precision = 1;
        }

        $max = $max / pow(10, $precision);
        $max = ceil($max);
        $max =  $max * pow(10, $precision);

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
                $set['backgroundColor'][] = $this->hex2rgba($chart->color, 0.1);
                $set['borderColor'][] = $chart->color;
                $set['borderWidth'][] = 1;

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

    public function hex2rgba($color, $opacity = false) {
 
        $default = 'rgb(0,0,0)';
     
        //Return default if no color provided
        if(empty($color))
              return $default; 
     
        //Sanitize $color if "#" is provided 
            if ($color[0] == '#' ) {
                $color = substr( $color, 1 );
            }
     
            //Check if color has 6 or 3 characters and get values
            if (strlen($color) == 6) {
                    $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
            } elseif ( strlen( $color ) == 3 ) {
                    $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
            } else {
                    return $default;
            }
     
            //Convert hexadec to rgb
            $rgb =  array_map('hexdec', $hex);
     
            //Check if opacity is set(rgba or rgb)
            if($opacity){
                if(abs($opacity) > 1)
                    $opacity = 1.0;
                $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
            } else {
                $output = 'rgb('.implode(",",$rgb).')';
            }
     
            //Return rgb(a) color string
            return $output;
    }
}
