<?php

namespace uraankhayayaal\page\widgets\photoswipe;

use yii\base\Widget;
use uraankhayayaal\page\widgets\photoswipe\PhotoSwipeAsset;

class PhotoSwipeWidget extends Widget {
    public function run() {
        $assetBundle = PhotoSwipeAsset::register($this->getView());
        return $this->render('index', [
            'assetBundle' => $assetBundle,
        ]);
    }
}