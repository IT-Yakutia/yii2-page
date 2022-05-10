<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\page\models\PageBlockChartLabel */

$this->title = 'Новый заголовок графика: '. $model->block->title;
// $this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-block-chart-label-create">
    <div class="row">
        <div class="col s12">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
	</div>
</div>
