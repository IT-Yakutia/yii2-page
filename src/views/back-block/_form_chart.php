<?php

use dosamigos\chartjs\ChartJs;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use uraankhayayaal\materializecomponents\checkbox\WCheckbox;
use uraankhayayaal\page\models\PageBlock;
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

    if ($model->isNewRecord) {
        echo $form->field($model, 'chart_type')->dropDownList(PageBlockChart::TYPE_NAMES);
    } elseif ($model->chart_type === PageBlockChart::LINE) {
        $line = [PageBlockChart::LINE => PageBlockChart::TYPE_NAMES[PageBlockChart::LINE]];
        echo $form->field($model, 'chart_type')->dropDownList($line);
    } else {
        $chart_types = PageBlockChart::TYPE_NAMES;
        unset($chart_types[PageBlockChart::LINE]);
        echo $form->field($model, 'chart_type')->dropDownList($chart_types);
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

    <p></p>

    <?php if (!$model->isNewRecord) { ?>

        <div class="row">
            <div class="col s12">
                <?php
                $type = $model->chart_type === PageBlockChart::LINE ? 'графики' : 'данные';

                if ($model->chart_type === PageBlockChart::LINE) {
                    echo Html::a(
                        'Добавить заголовки',
                        [
                            '/page/back-block-chart-label/index',
                            'block_id' => $model->id
                        ],
                        ['class' => 'btn']
                    );
                    echo '<p></p>';
                }

                echo Html::a(
                    "Добавить $type",
                    [
                        '/page/back-block-chart/index',
                        'block_id' => $model->id
                    ],
                    ['class' => 'btn']
                );

                ?>
            </div>
        </div>

        <p></p>
        <div class="row">
            <div class="col s12 m12 l12 xl8">
                <?php
                $chart_type = array_search($model->chart_type, PageBlockChart::TYPES);
                $data = $model->getCharts($chart_type);
                echo ChartJs::widget($data);
                ?>
            </div>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>