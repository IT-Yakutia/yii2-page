<?php

use kartik\color\ColorInput;
use uraankhayayaal\materializecomponents\checkbox\WCheckbox;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\page\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-block-chart-param-form">

    <?php $form = ActiveForm::begin([
        'errorCssClass' => 'red-text',
    ]); ?>

    <?= WCheckbox::widget(['model' => $model, 'attribute' => 'is_publish']); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value')->textInput(['type' => 'number']) ?>

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