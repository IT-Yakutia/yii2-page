<?php

use dosamigos\chartjs\ChartJs;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use uraankhayayaal\materializecomponents\checkbox\WCheckbox;
use uraankhayayaal\page\models\PageBlockChart;

?>

<div class="page-chart-form">

    <?php $form = ActiveForm::begin([
        'errorCssClass' => 'red-text',
    ]); ?>

    <?php
    if ($model->isNewRecord) {
        echo $form->field($model, 'is_publish')->hiddenInput(['value' => 0])->label(false);
        echo '<p>График можно будет опубликовать после добавления</p>';
    } else {
        echo WCheckbox::widget(['model' => $model, 'attribute' => 'is_publish']);
    }
    ?>

    <?= $form->field($model, 'chart_type')->dropDownList(PageBlockChart::TYPE_NAMES) ?>

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

    <p></p>

    <?php
    if (!$model->isNewRecord) {
        echo Html::a('Добавить данные', ['/page/back-block-chart/index', 'block_id' => $model->id], ['class' => 'btn']);

        $chart_type = array_search($model->chart_type, PageBlockChart::TYPES);
        $data = $model->getCharts($chart_type);
    ?>
        <p></p>
        <div class="row">
            <div class="col s12 m12 l12 xl8">
                <?= ChartJs::widget($data) ?>
            </div>
        </div>

    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>