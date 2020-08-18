<?php

/* @var $this yii\web\View */
/* @var $model common\modules\page\models\PageBlock */

$this->title = $model::TYPE_NAMES[$type] ?? '';
?>
<div class="page-create">
	<div class="row">
		<div class="col s12">
			<?= $this->render('_form_' . array_search($type, $model::TYPES), [
				'model' => $model,
				'type' => $type,
				'page_id' => $page_id
			]); ?>
		</div>
	</div>
</div>