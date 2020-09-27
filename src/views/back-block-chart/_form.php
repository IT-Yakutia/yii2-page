<?php

use kartik\color\ColorInput;
use uraankhayayaal\materializecomponents\checkbox\WCheckbox;
use uraankhayayaal\page\models\PageBlockChart;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\page\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-block-chart-form">
    <p></p>
    <?= Html::a('к странице: <b>' . $model->block->page->title . '</b>', ['back/update', 'id' => $model->block->page->id], Yii::$app->params['nav_options']) ?> |
    <?= Html::a('к блоку: <b>' . $model->block->title . '</b>', ['back-block/update', 'id' => $model->block->id], Yii::$app->params['nav_options']) ?> |
    <?= Html::a($model->block->chart_type === PageBlockChart::LINE ? 'к графикам' : 'к данным', ['back-block-chart/index', 'block_id' => $model->block->id], Yii::$app->params['nav_options']) ?>
    <?php if($model->block->chart_type === PageBlockChart::LINE) { ?>
       | <?= Html::a('к заголовкам', ['back-block-chart-label/index', 'block_id' => $model->block->id], Yii::$app->params['nav_options']) ?>
    <?php } ?>
    <p></p>
    <?php if (!$model->isNewRecord && $model->block->chart_type === PageBlockChart::LINE) { ?>
        <?= Html::a('Добавить параметры', ['back-block-chart-param/index', 'chart_id' => $model->id], ['class' => 'btn']) ?>
        <p></p>
    <?php } ?>

    <?php $form = ActiveForm::begin([
        'errorCssClass' => 'red-text',
    ]); ?>

    <?= WCheckbox::widget(['model' => $model, 'attribute' => 'is_publish']); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php
    if ($model->block->chart_type !== PageBlockChart::LINE) {
        echo $form->field($model, 'value')->textInput(['type' => 'number']);
    } else {
        echo $form->field($model, 'value')->hiddenInput(['value' => '10'])->label(false);
    }
    ?>

    <?= $form->field($model, 'color')->widget(ColorInput::class, [
            'name' => 'color_32',
            'value' => 'rgb(100, 50, 200)',
            'options' => ['placeholder' => 'Choose your color ...', 'readonly' => true],
            'pluginOptions' => [
                'showInput' => false,
                'preferredFormat' => 'rgb'
            ],
            'useNative' => true,
            'width' => '75%',
        ]);
    ?>

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

    <p></p>
    <?php ActiveForm::end(); ?>

</div>