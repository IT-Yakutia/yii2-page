<?php

use yii\bootstrap4\Carousel;

?>

<div class="row">
    <div class="col">
        <h3><?= $title ?></h3>
    </div>
</div>

<div class="row">
    <div class="col">
        <?= Carousel::widget([
            'items' => $items
        ]); ?>
    </div>
</div>