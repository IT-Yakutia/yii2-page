<?php

namespace uraankhayayaal\page\widgets\photoswipe;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class PhotoSwipeAsset extends AssetBundle
{
    public $sourcePath = '@uraankhayayaal/page/widgets/photoswipe/assets/';

    public $css = [
        'src/PhotoSwipe/photoswipe.css',
        'src/PhotoSwipe/default-skin/default-skin.css',
    ];
    public $js = [
        'src/PhotoSwipe/photoswipe.min.js',
        'src/PhotoSwipe/photoswipe-ui-default.min.js',
        'src/jqPhotoSwipe.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}