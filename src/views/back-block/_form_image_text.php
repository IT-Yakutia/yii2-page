<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use uraankhayayaal\materializecomponents\checkbox\WCheckbox;
use uraankhayayaal\materializecomponents\imgcropper\Cropper;
use uraankhayayaal\redactor\RedactorWidget;
use yii\helpers\Url;

?>

<div class="page-image-text-form">

    <?php $form = ActiveForm::begin([
        'errorCssClass' => 'red-text',
    ]); ?>

    <?= WCheckbox::widget(['model' => $model, 'attribute' => 'is_publish']); ?>

    <?= /* скрытый инпут */ $form->field($model, 'type')->hiddenInput(['value' => $type])->label(false) ?>
    <?= /* скрытый инпут */ $form->field($model, 'page_id')->hiddenInput(['value' => $page_id])->label(false) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'photo')->widget(Cropper::class, [
        'aspectRatio' => 380/380,
        'maxSize' => [1380, 1380, 'px'],
        'minSize' => [10, 10, 'px'],
        'startSize' => [100, 100, '%'],
        'uploadUrl' => Url::to(['/page/back-block/uploadImg']),
    ]); ?>

    <?= $form->field($model, 'content')->widget(RedactorWidget::class, [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            // 'imageUpload' => Url::to(['/page/back/image-upload']),
            // 'fileUpload' => Url::to(['/page/back/file-upload']),
            // 'imageManagerJson' => Url::to(['/page/back/images-get']),
            // 'fileManagerJson' => Url::to(['/page/back/files-get']),
            'plugins' => [
                'fullscreen',
                // 'imagemanager',
                // 'filemanager',
                'fontcolor',
                'fontfamily',
                'fontsize',
                'limiter',
                'table',
                'textdirection',
                'textexpander',
            ]
        ],
        'class' => 'materialize-textarea',
    ]); ?>

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
