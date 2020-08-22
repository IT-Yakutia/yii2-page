<?php

/* @var $this yii\web\View */
/* @var $model common\modules\page\models\PageBlockFaq */

$this->title = 'Редактирование: ' . $model->title;
?>
<div class="page-update">
    <div class="row">
        <div class="col s12">
		    <?= $this->render('_form', [
                'model' => $model,
                'block_id' => $block_id
		    ]) ?>
		</div>
	</div>
</div>