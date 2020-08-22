<?php

use Faker\Factory;
use uraankhayayaal\page\models\Page;
use uraankhayayaal\page\models\PageBlock;

$data = [];
$faker = Factory::create();
$params = require('_config.php');

$pages = Page::find()->all();
foreach($pages as $page) {
    $blocks = $page->getPageBlocks()->all();
    foreach($blocks as $block) {
        if($block->type !== PageBlock::GALLERY_TYPE) {
            continue;
        }

        for ($f = 0; $f < $params['pageBlockGalleryCount']; $f++) {
            $data[] = [
                'block_id' => $block->id,
                'photo_id' => $f + 1
            ];
        }
    }
}

return $data;