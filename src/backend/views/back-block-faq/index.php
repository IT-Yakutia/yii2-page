<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\page\models\PageBlockFaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Вкладки FAQ';
// $this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-block-faq-index">
    <div class="row">
        <div class="col s12">
            <p></p>
            <?= Html::a('Главная', ['/']) ?> /
            <?= Html::a('Страницы', ['back/index']) ?> /
            <?= Html::a($model->page->title, ['back/update', 'id' => $model->page->id]) ?> /
            <?= Html::a($model->title, ['back-block/update', 'id' => $model->id]) ?>
            <p>
                <?= Html::a('Добавить новую вкладку', ['back-block-faq/create', 'block_id' => $model->id], ['class' => 'btn btn-success']) ?>
            </p>
            <div class="fixed-action-btn">
                <?= Html::a('<i class="material-icons">add</i>', ['create'], [
                    'class' => 'btn-floating btn-large waves-effect waves-light tooltipped',
                    'title' => 'Сохранить',
                    'data-position' => "left",
                    'data-tooltip' => "Добавить",
                ]) ?>
            </div>

            <?= GridView::widget([
                'tableOptions' => [
                    'class' => 'striped bordered my-responsive-table',
                    'id' => 'sortable'
                ],
                'rowOptions' => function ($model, $key, $index, $grid) {
                    return ['data-sortable-id' => $model->id];
                },
                'options' => [
                    'data' => [
                        'sortable-widget' => 1,
                        'sortable-url' => \yii\helpers\Url::toRoute(['sorting']),
                    ]
                ],
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    ['class' => '\uraankhayayaal\materializecomponents\grid\MaterialActionColumn', 'template' => '{update}'],
                    [
                        'attribute' => 'title',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Html::a($model->title, ['update', 'id' => $model->id]);
                        }
                    ],
                    [
                        'attribute' => 'is_publish',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return $model->is_publish ? '<i class="material-icons green-text">done</i>' : '<i class="material-icons red-text">clear</i>';
                        },
                        'filter' => [0 => 'Нет', 1 => 'Да'],
                    ],
                    [
                        'attribute' => 'created_at',
                        'format' => 'datetime',
                    ],
                    ['class' => '\uraankhayayaal\materializecomponents\grid\MaterialActionColumn', 'template' => '{delete}'],
                    [
                        'class' => \uraankhayayaal\sortable\grid\Column::class,
                    ],
                ],
                'pager' => [
                    'class' => 'yii\widgets\LinkPager',
                    'options' => ['class' => 'pagination center'],
                    'prevPageCssClass' => '',
                    'nextPageCssClass' => '',
                    'pageCssClass' => 'waves-effect',
                    'nextPageLabel' => '<i class="material-icons">chevron_right</i>',
                    'prevPageLabel' => '<i class="material-icons">chevron_left</i>',
                ],
            ]);
            ?>
        </div>
    </div>
</div>