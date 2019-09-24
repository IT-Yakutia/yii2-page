<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\page\models\PageMenuItem */

$this->title = 'Редактирование: ' . $model->name;
// $this->params['breadcrumbs'][] = ['label' => 'Page Menu Items', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="page-menu-item-update">
    <div class="row">
        <div class="col s12">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
	</div>
</div>
