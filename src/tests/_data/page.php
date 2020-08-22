<?php

use Faker\Factory;

$data = [];
$faker = Factory::create();
$params = require('_config.php');

for ($i = 0; $i < $params['pageCount']; $i++) {
    $data[] = [
        'title' => 'Page: title - ' . $faker->words($nb = rand(3, 6), $asText = true),
        'slug' => 'someslug_'.$i,
        'no_title' => round(rand(4, 10) / 10, 0),
        // 'width_type' => round(rand(4, 10) / 10, 0),
        'content' => 'Page Content starts here - ' . $faker->text($maxNbChars = rand(2000, 4037)),
        'photo' => 'https://picsum.photos/id/' . (1) . '/525/525/',
        'sort' => null,
        'user_id' => 1,
        'is_publish' => round(rand(2, 10) / 10, 0),
        'status' => 10,
        // 'meta_keywords' => $faker->words($nb = rand(3, 6), $asText = true),
        // 'meta_description' => $faker->text($maxNbChars = rand(120, 237)),
        'created_at' => '1581434317',
        'updated_at' => '1581434317',
    ];
}

return $data;
