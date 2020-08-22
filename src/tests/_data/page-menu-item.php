<?php

use Faker\Factory;

$data = [];
$faker = Factory::create();
$params = require('_config.php');

for ($i = 0; $i < $params['pageMenuItemCount']; $i++) {
    $data[] = [
        'name' => $faker->words($nb = rand(1, 2), $asText = true),
        'sort' => null,
        'user_id' => 1,
        'is_publish' => round(rand(2, 10) / 10, 0),
        'status' => 10,
        'page_id' => 4 + $i,
        'page_menu_id' => 2 + round($i/25), // 1,5 -> 2
        'url' => null,
        'created_at' => '1581434317',
        'updated_at' => '1581434317',
    ];
}

return $data;
