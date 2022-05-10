<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\page\models\PageBlockChartLabel */

$this->title = 'Редактирование заголовка "' . $model->title . '" графика "'. $model->block->title . '"';
?>
<div class="page-block-chart-label-update">
    <div class="row">
        <div class="col s12">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
	</div>
</div>
