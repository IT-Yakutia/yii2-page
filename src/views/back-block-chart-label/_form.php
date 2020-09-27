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
    <?= Html::a('к странице: <b>' . $model->block->page->title . '</b>', ['back/update', 'id' => $model->block->page->id], Yii::$app->params['nav_options']) ?> |
    <?= Html::a('к блоку: <b>' . $model->block->title . '</b>', ['back-block/update', 'id' => $model->block->id], Yii::$app->params['nav_options']) ?> |
    <?= Html::a('к заголовкам', ['back-block-chart-label/index', 'block_id' => $model->block->id], Yii::$app->params['nav_options']) ?> |
    <?= Html::a('к графикам', ['back-block-chart/index', 'block_id' => $model->block->id], Yii::$app->params['nav_options']) ?>
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