<?php


namespace uraankhayayaal\page\tests\fixtures;


use yii\test\ActiveFixture;
use uraankhayayaal\page\models\PageMenuItem;

class PageMenuItemFixture extends ActiveFixture
{
    public $modelClass = PageMenuItem::class;
    public $dataFile = '@uraankhayayaal/page/tests/_data/page-menu-item.php';
    public $depends = [PageMenuFixture::class, PageFixture::class];
}
