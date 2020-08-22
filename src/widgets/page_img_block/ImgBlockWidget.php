<?php

namespace uraankhayayaal\page\widgets\page_img_block;

use yii\base\Widget;

class ImgBlockWidget extends Widget {
    public $data;

    public function run() {
        return $this->render('index', [
            'title' => $this->data['title'],
            'content' => $this->data['content'],
            'photo' => $this->data['photo'],
        ]);
    }
}