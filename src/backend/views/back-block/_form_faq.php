<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use uraankhayayaal\materializecomponents\checkbox\WCheckbox;

?>

<div class="page-faq-form">
    <p></p>
    <?= Html::a('Главная', ['/']) ?> /
    <?= Html::a('Страницы', ['back/index']) ?> /
    <?= Html::a($model->page->title, ['back/update', 'id' => $model->page->id]) ?>
    <?php if (!$model->isNewRecord) {
        $faqs = $model->getPageBlockFaq();
    ?>
        <p></p>
        <div class="row">
            <div class="col s12 m12 l12">

                <?= Html::a('Добавить новые вкладки', ['back-block-faq/index', 'block_id' => $model->id], ['class' => 'btn']) ?>
            </div>
        </div>
    <?php } ?>
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