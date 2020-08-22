<?php

use yii\bootstrap4\Accordion;

?>

<div class="row">
    <div class="col">
        <h3><?= $title ?></h3>
    </div>
</div>

<div class="row">
    <div class="col">
        <?= Accordion::widget([
            'items' => $items
        ]);?>
    </div>
</div>