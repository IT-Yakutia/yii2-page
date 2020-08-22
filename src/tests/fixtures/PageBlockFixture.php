<?php

namespace uraankhayayaal\page\tests\fixtures;

use uraankhayayaal\page\models\PageBlock;
use yii\test\ActiveFixture;

class PageBlockFixture extends ActiveFixture
{
    public $modelClass = PageBlock::class;
    public $dataFile = '@uraankhayayaal/page/tests/_data/page-block.php';
    public $depends = [PageFixture::class];
}