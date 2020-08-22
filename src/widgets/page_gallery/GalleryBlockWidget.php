<?php

namespace uraankhayayaal\page\widgets\page_gallery;

use yii\base\Widget;

class GalleryBlockWidget extends Widget {
    public $data;

    public function run() {
        return $this->render('index', [
            'title' => $this->data['title'],
            'items' => $this->data['items']
        ]);
    }
}