<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use uraankhayayaal\materializecomponents\checkbox\WCheckbox;
use uraankhayayaal\page\models\PageBlock;
use uraankhayayaal\redactor\RedactorWidget;
use yii\helpers\Url;

?>

<div class="page-raw-text-form">
    <p></p>
    <?= Html::a('Главная', ['/']) ?> /
    <?= Html::a('Страницы', ['back/index']) ?> /
    <?= Html::a($model->page->title, ['back/update', 'id' => $model->page->id]) ?>
    <?php $form = ActiveForm::begin([
        'errorCssClass' => 'red-text',
    ]); ?>

    <?= WCheckbox::widget(['model' => $model, 'attribute' => 'is_publish']); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(RedactorWidget::class, [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'imageUpload' => Url::to(['/page/back-block/image-upload']),
            'fileUpload' => Url::to(['/page/back-block/file-upload']),
            'imageManagerJson' => Url::to(['/page/back-block/images-get']),
            'fileManagerJson' => Url::to(['/page/back-block/files-get']),
            'plugins' => [
                'fullscreen',
                'imagemanager',
                'filemanager',
                'fontcolor',
                'fontfamily',
                'fontsize',
                'limiter',
                'table',
                'textdirection',
                'textexpander',
                'video',
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