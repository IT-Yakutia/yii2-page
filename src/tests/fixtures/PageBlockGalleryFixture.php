<?php

namespace uraankhayayaal\page\tests\fixtures;

use ityakutia\gallery\models\GalleryPageBlock;
use ityakutia\gallery\tests\fixtures\GalleryPhotoFixture;
use yii\test\ActiveFixture;

class PageBlockGalleryFixture extends ActiveFixture
{
    public $modelClass = GalleryPageBlock::class;
    public $dataFile = '@uraankhayayaal/page/tests/_data/page-block-gallery.php';
    public $depends = [PageBlockFaqFixture::class, GalleryPhotoFixture::class];
}