<?php


namespace uraankhayayaal\page\tests\fixtures;


use yii\test\ActiveFixture;
use uraankhayayaal\page\models\PageMenu;

class PageMenuFixture extends ActiveFixture
{
    public $modelClass = PageMenu::class;
    public $dataFile = '@uraankhayayaal/page/tests/_data/page-menu.php';
}
