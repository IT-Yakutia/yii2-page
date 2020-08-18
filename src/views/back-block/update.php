<?php

/* @var $this yii\web\View */
/* @var $model common\modules\page\models\PageBlock */

$this->title = 'Редактирование: ' . $model->title;
?>
<div class="page-update">
    <div class="row">
        <div class="col s12">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
	</div>
</div>
