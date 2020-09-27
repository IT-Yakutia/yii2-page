<?php

use uraankhayayaal\materializecomponents\checkbox\WCheckbox;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\page\models\Page */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="page-form">
    <p></p>
    <?= Html::a('На главную', ['/'], Yii::$app->params['nav_options']) ?> |
    <?= Html::a('к страницам', ['index'], Yii::$app->params['nav_options']) ?>
    <p></p>
    <ul class="tabs">
        <li class="tab col s3"><a class="active" href="#page_tab_main">Основное</a></li>
        <li class="tab col s3 <?= $model->isNewRecord ? "disabled" : ""; ?>"><a href="#page_tab_blocks" class="<?= $model->isNewRecord ? "tooltipped" : ""; ?>" data-position="bottom" data-tooltip="Вкладка будет доступна после сохранения страницы">Блоки страницы</a></li>
    </ul>

    <div id="page_tab_main">
        <?php $form = ActiveForm::begin([
            'errorCssClass' => 'red-text',
        ]); ?>

        <?php 
            if($model->isNewRecord) {
                echo '<p>Страницу можно будет опубликовать только после сохранения</p>';
                $form->field($model, 'is_publish')->hiddenInput(['value' => 0])->label(false);
            } else {
                echo WCheckbox::widget(['model' => $model, 'attribute' => 'is_publish']);
            }
        ?>

        <?= WCheckbox::widget(['model' => $model, 'attribute' => 'no_title']); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

        <?php if (!$model->isNewRecord) { ?>
            <div class="input-field">
                <input disabled value="<?= '/' . $model->slug; ?>" id="disabled" type="text" class="validate">
                <label for="disabled">Относительный url страницы</label>
            </div>

            <div class="input-field">
                <input disabled value="<?= Yii::$app->params['domain'] . $model->slug; ?>" id="disabled" type="text" class="validate">
                <label for="disabled">Асолютный url страницы</label>
                <?= Html::a("Перейти", Yii::$app->urlManagerFrontend->createUrl(['/page/front/view', 'slug' => $model->slug]), ['target' => "_blank"]); ?>
            </div>
        <?php } ?>

        <?= $form->field($model, 'photo')->widget(\uraankhayayaal\materializecomponents\imgcropper\Cropper::className()::className(), [
            'aspectRatio' => 380 / 380,
            'maxSize' => [1380, 1380, 'px'],
            'minSize' => [10, 10, 'px'],
            'startSize' => [100, 100, '%'],
            'uploadUrl' => Url::to(['/page/back/uploadImg']),
        ]); ?>

        <?= $form->field($model, 'content')->widget(\uraankhayayaal\redactor\RedactorWidget::className(), [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 200,
                'imageUpload' => Url::to(['/page/back/image-upload']),
                'fileUpload' => Url::to(['/page/back/file-upload']),
                'imageManagerJson' => Url::to(['/page/back/images-get']),
                'fileManagerJson' => Url::to(['/page/back/files-get']),
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

    <div id="page_tab_blocks">
        <?php if (!$model->isNewRecord) { ?>
            <p></p>
            <div class="row">
                <div class="col s12 m12 l12 xl8">
                    <?= $this->context->renderPartial('/back-block/index', [
                        'page_id' => $model->id,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                    ]) ?>
                </div>
            </div>
        <?php  } ?>
    </div>

</div>