<?php

namespace uraankhayayaal\page\widgets\page_text;

use yii\base\Widget;

class TextBlockWidget extends Widget {
    public $data;

    public function run() {
        return $this->render('index', [
            'title' => $this->data['title'],
            'content' => $this->data['content'],
        ]);
    }
}