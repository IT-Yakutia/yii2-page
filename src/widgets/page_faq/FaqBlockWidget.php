<?php

namespace uraankhayayaal\page\widgets\page_faq;

use yii\base\Widget;

class FaqBlockWidget extends Widget {
    public $data;

    public function run() {
        return $this->render('index', [
            'title' => $this->data['title'],
            'items' => $this->data['items'],
        ]);
    }

}