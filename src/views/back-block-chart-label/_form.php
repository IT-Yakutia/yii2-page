<?php

use uraankhayayaal\materializecomponents\checkbox\WCheckbox;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\page\models\PageBlockChartLabel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-block-chart-label-form">
    <p></p>
    <?= Html::a('Главная', ['/']) ?> /
    <?= Html::a('Страницы', ['back/index']) ?> /
    <?= Html::a($model->block->page->title, ['back/update', 'id' => $model->block->page->id]) ?> /
    <?= Html::a($model->block->title, ['back-block/update', 'id' => $model->block->id]) ?> /
    <?= Html::a('Заголовки', ['back-block-chart-label/index', 'block_id' => $model->block->id]) ?> /
    <?= Html::a('Графики', ['back-block-chart/index', 'block_id' => $model->block->id]) ?>
    <?php $form = ActiveForm::begin([
        'errorCssClass' => 'red-text',
    ]); ?>

    <?= WCheckbox::widget(['model' => $model, 'attribute' => 'is_publish']); ?>

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