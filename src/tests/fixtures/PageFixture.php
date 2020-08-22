<?php


namespace uraankhayayaal\page\tests\fixtures;


use yii\test\ActiveFixture;
use uraankhayayaal\page\models\Page;

class PageFixture extends ActiveFixture
{
    public $modelClass = Page::class;
    public $dataFile = '@uraankhayayaal/page/tests/_data/page.php';
}
