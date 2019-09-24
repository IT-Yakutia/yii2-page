<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\page\models\PageMenu */

$this->title = 'Новое меню';
// $this->params['breadcrumbs'][] = ['label' => 'Page Menus', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-menu-create">
	<div class="row">
        <div class="col s12">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
	</div>
</div>
