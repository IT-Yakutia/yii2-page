<?php

use yii\bootstrap4\Carousel;
use uraankhayayaal\page\widgets\photoswipe\PhotoSwipeAsset;

$assetBundle = PhotoSwipeAsset::register($this);

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

<?php
$js = <<< JS
    // $(document).ready(function () {
        //By default, plugin uses `data-fancybox-group` attribute to create galleries.
        $(".fancybox").jqPhotoSwipe({
            galleryOpen: function (gallery) {
                //with `gallery` object you can access all methods and properties described here http://photoswipe.com/documentation/api.html
                // console.log(gallery);
                // console.log(gallery.currItem);
                // console.log(gallery.getCurrentIndex());
                // gallery.zoomTo(1, {x:gallery.viewportSize.x/2,y:gallery.viewportSize.y/2}, 500);
                // gallery.toggleDesktopZoom();
            }
        });
        //This option forces plugin to create a single gallery and ignores `data-fancybox-group` attribute.
        $(".forcedgallery > a").jqPhotoSwipe({
            forceSingleGallery: true
        });
    // });
JS;
$this->registerJs($js, static::POS_READY);
?>