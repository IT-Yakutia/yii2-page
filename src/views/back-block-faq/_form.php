<?php

use uraankhayayaal\materializecomponents\checkbox\WCheckbox;
use uraankhayayaal\redactor\RedactorWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<div class="page-block-faq-form">
    <p></p>
    <?= Html::a('к странице: <b>' . $model->block->page->title . '</b>', ['back/update', 'id' => $model->block->page->id], Yii::$app->params['nav_options']) ?> | 
    <?= Html::a('к блоку: <b>' . $model->block->title . '</b>', ['back-block/update', 'id' => $model->block->id], Yii::$app->params['nav_options']) ?> 
    <?php $form = ActiveForm::begin([
        'errorCssClass' => 'red-text',
    ]); ?>

    <?= WCheckbox::widget(['model' => $model, 'attribute' => 'is_publish']); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'content')->widget(RedactorWidget::class, [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'imageUpload' => Url::to(['/page/back-block-faq/image-upload']),
            'fileUpload' => Url::to(['/page/back-block-faq/file-upload']),
            'imageManagerJson' => Url::to(['/page/back-block-faq/images-get']),
            'fileManagerJson' => Url::to(['/page/back-block-faq/files-get']),
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