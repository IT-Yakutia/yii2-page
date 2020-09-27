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

<div class="page-block-chart-param-form">
    <p></p>
    <?= Html::a('к странице: <b>' . $model->chart->block->page->title . '</b>', ['back/update', 'id' => $model->chart->block->page->id], Yii::$app->params['nav_options']) ?> |
    <?= Html::a('к блоку: <b>' . $model->chart->block->title . '</b>', ['back-block/update', 'id' => $model->chart->block->id], Yii::$app->params['nav_options']) ?> | 
    <?= Html::a('к графикам', ['back-block-chart/index', 'block_id' => $model->chart->block->id], Yii::$app->params['nav_options']) ?> |
    <?= Html::a('к графику: <b>' . $model->chart->title . '</b>', ['back-block-chart/update', 'id' => $model->chart->id], Yii::$app->params['nav_options']) ?> |
    <?= Html::a('к заголовкам', ['back-block-chart-label/index', 'block_id' => $model->chart->block->id], Yii::$app->params['nav_options']) ?>
    
    <?php $form = ActiveForm::begin([
        'errorCssClass' => 'red-text',
    ]); ?>

    <?= WCheckbox::widget(['model' => $model, 'attribute' => 'is_publish']); ?>

    <?php
    if ($model->chart->block->chart_type === PageBlockChart::LINE) {
        if (empty($chart_labels)) {
            echo '<p>Добавьте новые заголовки графиков!</p>';
        }
        echo $form->field($model, 'title')->dropDownList($chart_labels);
    } else {
        echo $form->field($model, 'title')->textInput(['maxlength' => true]);
    }
    ?>

    <?= $form->field($model, 'value')->textInput(['type' => 'number']) ?>

    <?php
    if ($model->chart->block->chart_type !== PageBlockChart::LINE) {
        echo $form->field($model, 'color')->widget(ColorInput::class, [
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
    }
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

    <?php ActiveForm::end(); ?>

</div>