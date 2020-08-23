<?php

use Faker\Factory;
use uraankhayayaal\page\models\PageBlock;
use uraankhayayaal\page\models\PageBlockChart;
use uraankhayayaal\page\models\PageBlockChartParam;

$data = [];
$faker = Factory::create();
$params = require('_config.php');

// pages
for ($p = 0; $p < $params['pageCount']; $p++) {
    // blocks
    $page_id = $p + 1;
    for ($b = 0; $b < $params['pageBlockCount']; $b++) {
        $data[] = [
            'title' => 'Raw Block: title - ' . $faker->words($nb = rand(3, 6), $asText = true),
            'content' => $faker->text($maxNbChars = rand(2000, 4037)),
            'type' => PageBlock::RAW_TEXT_TYPE,
            'page_id' => $page_id,
            'sort' => null,
            'is_publish' => round(rand(2, 10) / 10, 0),
            'status' => 10,
            'created_at' => '1581434317',
            'updated_at' => '1581434317',
        ];

        $data[] = [
            'title' => 'Image Text Block: title - ' . $faker->words($nb = rand(3, 6), $asText = true),
            'content' => $faker->text($maxNbChars = rand(2000, 4037)),
            'type' => PageBlock::IMAGE_TEXT_TYPE,
            'page_id' => $page_id,
            'photo' => 'https://picsum.photos/id/' . (1) . '/525/525/',
            'sort' => null,
            'is_publish' => round(rand(2, 10) / 10, 0),
            'status' => 10,
            'created_at' => '1581434317',
            'updated_at' => '1581434317',
        ];

        $data[] = [
            'title' => 'Faq Block: title - ' . $faker->words($nb = rand(3, 6), $asText = true),
            'type' => PageBlock::FAQ_TYPE,
            'page_id' => $page_id,
            'sort' => null,
            'is_publish' => round(rand(2, 10) / 10, 0),
            'status' => 10,
            'created_at' => '1581434317',
            'updated_at' => '1581434317',
        ];

        $data[] = [
            'title' => 'Gallery block: title - ' . $faker->words($nb = rand(3, 6), $asText = true),
            'type' => PageBlock::GALLERY_TYPE,
            'page_id' => $page_id,
            'sort' => null,
            'is_publish' => round(rand(2, 10) / 10, 0),
            'status' => 10,
            'created_at' => '1581434317',
            'updated_at' => '1581434317',
        ];

        $data[] = [
            'title' => 'Chart block: title - ' . $faker->words($nb = rand(3, 6), $asText = true),
            'type' => PageBlock::CHART_TYPE,
            'page_id' => $page_id,
            'chart_type' => array_rand(array_values(PageBlockChart::TYPES), 1),
            'sort' => null,
            'is_publish' => round(rand(2, 10) / 10, 0),
            'status' => 10,
            'created_at' => '1581434317',
            'updated_at' => '1581434317',
        ];
    }
}

return $data;