<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\modules\page\models\PageMenuItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-menu-item-form">

    <?php $form = ActiveForm::begin([
        'errorCssClass' => 'red-text',
    ]); ?>

    <?= \uraankhayayaal\materializecomponents\checkbox\WCheckbox::widget(['model' => $model, 'attribute' => 'is_publish']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map(
        empty($model->parent_id) ? \uraankhayayaal\page\models\PageMenuItem::find()->where(['parent_id' => null])->all() : \uraankhayayaal\page\models\PageMenuItem::find()->where(['parent_id' => null])->orWhere(['parent_id' => $model->parent_id])->all()
        ,'id','name'), ['prompt' => 'Выберите']) ?>

    <?= $form->field($model, 'page_id')->dropDownList(
        ArrayHelper::map(
            empty($model->page_id) ? \uraankhayayaal\page\models\Page::find()->joinWith('pageMenuItems')->where(['page_id' => null])->all() : \uraankhayayaal\page\models\Page::find()->joinWith('pageMenuItems')->where(['page_id' => null])->orWhere(['page_id' => $model->page_id])->all()
        ,'id','title'), ['prompt' => 'Выберите']) ?>

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
