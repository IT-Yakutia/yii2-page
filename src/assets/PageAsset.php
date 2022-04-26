<?php

namespace uraankhayayaal\page\assets;

use yii\web\AssetBundle;

class PageAsset extends AssetBundle
{
    public $sourcePath = '@uraankhayayaal/page/assets/src/';
    
    public $css = [
    ];
    public $js = [
        'page-back.js',
    ];
    public $depends = [
        // 'backend\assets\AppAsset',
    ];
}