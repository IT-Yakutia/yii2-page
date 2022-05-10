<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\page\models\PageMenuItem */

$this->title = 'Новый элемент меню';
// $this->params['breadcrumbs'][] = ['label' => 'Page Menu Items', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-menu-item-create">
	<div class="row">
        <div class="col s12">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
	</div>
</div>
