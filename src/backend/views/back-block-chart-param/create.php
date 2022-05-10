<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\page\models\PageBlockChartParam */

$this->title = 'Новый параметр графика: '. $model->chart->title;
// $this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-block-chart-param-create">
    <div class="row">
        <div class="col s12">
		    <?= $this->render('_form', [
				'model' => $model,
				'chart_labels' => $chart_labels,
		    ]) ?>
		</div>
	</div>
</div>
