<?php

namespace uraankhayayaal\page\tests\fixtures;

use uraankhayayaal\page\models\PageBlockFaq;
use yii\test\ActiveFixture;

class PageBlockFaqFixture extends ActiveFixture
{
    public $modelClass = PageBlockFaq::class;
    public $dataFile = '@uraankhayayaal/page/tests/_data/page-block-faq.php';
    public $depends = [PageBlockFixture::class];
}