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
        if($block->type !== PageBlock::FAQ_TYPE) {
            continue;
        }

        for ($f = 0; $f < $params['pageBlockFaqCount']; $f++) {
            $data[] = [
                'title' => 'Block Faq: title - ' . $faker->words($nb = rand(3, 6), $asText = true),
                'content' => $faker->text($maxNbChars = rand(500, 1000)),
                'block_id' => $block->id,
                'sort' => null,
                'is_publish' => round(rand(2, 10) / 10, 0),
                'status' => 10,
                'created_at' => '1581434317',
                'updated_at' => '1581434317',
            ];
        }
    }
}

return $data;
