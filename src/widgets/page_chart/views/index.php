<?php

// use dosamigos\chartjs\ChartJs;

use phpnt\chartJS\ChartJs;

?>

<div class="row">
    <div class="col">
        <h3><?= $title ?></h3>
    </div>
</div>

<div class="row">
    <div class="col">
        <?= ChartJs::widget($data) ?>
    </div>
</div>