<div class="forcedgallery">
	1.
	<p>
		<a class="fancybox" data-fancybox-group="gallery1" href="https://cdn.photoswipe.com/photoswipe-demo-images/photos/2/img-2500.jpg" title="Photo Caption #1" alt="Photo Caption #1"><img src="https://cdn.photoswipe.com/photoswipe-demo-images/photos/2/img-200.jpg" border="0" class="thumb"></a>
		<a class="fancybox" data-fancybox-group="gallery1" href="https://cdn.photoswipe.com/photoswipe-demo-images/photos/7/img-2500.jpg" title="Photo Caption #2" alt="Photo Caption #1"><img src="https://cdn.photoswipe.com/photoswipe-demo-images/photos/7/img-200.jpg" border="0" class="thumb"></a>
	</p>
	2.
	<p>
		<a class="fancybox" data-fancybox-group="gallery1" href="https://cdn.photoswipe.com/photoswipe-demo-images/photos/3/img-2500.jpg" title="Photo Caption #3" alt="Photo Caption #1"><img src="https://cdn.photoswipe.com/photoswipe-demo-images/photos/3/img-200.jpg" border="0" class="thumb"></a>
		<a class="fancybox" data-fancybox-group="gallery1" href="https://cdn.photoswipe.com/photoswipe-demo-images/photos/6/img-2500.jpg" title="Photo Caption #4" alt="Photo Caption #1"><img src="https://cdn.photoswipe.com/photoswipe-demo-images/photos/6/img-200.jpg" border="0" class="thumb"></a>
	</p>
</div>

<?php
$js = <<< JS
    console.log('asdasdasdasdasdasdad');
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