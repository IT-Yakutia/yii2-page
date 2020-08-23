<?php

namespace uraankhayayaal\page\tests\fixtures;

use uraankhayayaal\page\models\PageBlockChart;
use yii\test\ActiveFixture;

class PageBlockChartFixture extends ActiveFixture
{
    public $modelClass = PageBlockChart::class;
    public $dataFile = '@uraankhayayaal/page/tests/_data/page-block-chart.php';
    public $depends = [PageBlockGalleryFixture::class];
}