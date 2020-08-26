<?php

use ityakutia\gallery\models\GalleryAlbumPhoto;
use ityakutia\gallery\models\GalleryPageBlock;
use ityakutia\gallery\widgets\imgUploader\WGalleryImgUploader;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use uraankhayayaal\materializecomponents\checkbox\WCheckbox;
use uraankhayayaal\page\models\PageBlock;

?>

<div class="page-gallery-form">

    <ul class="tabs">
        <li class="tab col s3"><a class="active" href="#page_block_gallery_tab_main">Основное</a></li>
        <li class="tab col s3 <?= $model->isNewRecord ? 'disabled' : ''; ?>"><a href="#page_block_gallery_tab" class="<?= $model->isNewRecord ? 'tooltipped' : ''; ?>" data-position="bottom" data-tooltip="Вкладка будет доступна после сохранения">Фотогалерея</a></li>
    </ul>

    <div class="page_block_gallery_tab_main">
    <?php $form = ActiveForm::begin([
        'errorCssClass' => 'red-text',
    ]); ?>

    <?php 
        if ($model->isNewRecord) {
            /* скрытый инпут */ echo $form->field($model, 'is_publish')->hiddenInput(['value' => 0])->label(false);
        } else {
            echo WCheckbox::widget(['model' => $model, 'attribute' => 'is_publish']);
        }
    ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn']) ?>
    </div>
    <div class="fixed-action-btn">
        <?= Html::submitButton('<i class="material-icons">save</i>', [
            'class' => 'btn-floating btn-large waves-effect waves-light tooltipped',
            'title' => 'Сохранить',
            'data-position' => "left",
            'data-tooltip' => "Сохранить",
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>

    <div id="page_block_gallery_tab">
        <?= WGalleryImgUploader::widget([
            'model' => $model,
            'galleryClass' => GalleryPageBlock::class,
        ]) ?>
    </div>

</div>