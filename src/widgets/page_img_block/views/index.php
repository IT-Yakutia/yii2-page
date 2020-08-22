<?php

?>

<div class="row">
    <div class="col">
        <h3><?= $title ?></h3>
    </div>
</div>

<div class="row">
    <?php if(!empty($photo)) { ?>
    <div class="col-12 col-md-6">
        <img class="w-100" src="<?= $photo ?>" alt="Img block image">
    </div>
    <?php } ?>
    <div class="col-12 col-md-6">
        <?= $content ?>
    </div>
</div>