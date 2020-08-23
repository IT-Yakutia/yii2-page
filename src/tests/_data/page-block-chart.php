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
        if($block->type !== PageBlock::CHART_TYPE) {
            continue;
        }

        for ($c = 0; $c < $params['pageBlockChartCount']; $c++) {
            $data[] = [
                'title' => $faker->words($nb = rand(1, 3), $asText = true),
                'value' => rand(50, 250),
                'block_id' => $block->id,
                'color' => $faker->hexcolor,
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