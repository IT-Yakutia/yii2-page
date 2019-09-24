<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\page\models\PageMenuItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $page_menu->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-menu-item-index">
    <div class="row">
        <div class="col s12">
            <p>
                <?= Html::a('Добавить', ['create', 'page_menu_id' => $page_menu->id], ['class' => 'btn btn-success']) ?>
            </p>
            <div class="fixed-action-btn">
                <?= Html::a('<i class="material-icons">add</i>', ['create', 'page_menu_id' => $page_menu->id], [
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
                    ['class' => 'uraankhayayaal\materializecomponents\grid\MaterialActionColumn', 'template' => '{update} {delete}'],

                    [
                        'attribute' => 'name',
                        'format' => 'raw',
                        'value' => function($model){
                            return Html::a($model->name,['update', 'id' => $model->id]);
                        }
                    ],
                    [
                        'attribute' => 'is_publish',
                        'format' => 'raw',
                        'value' => function($model){
                            return $model->is_publish ? '<i class="material-icons green-text">done</i>' : '<i class="material-icons red-text">clear</i>';
                        },
                        'filter' =>[0 => 'Нет', 1 => 'Да'],
                    ],
                    [
                        'attribute' => 'page_id',
                        'format' => 'raw',
                        'value' => function($model){
                            if(!isset($model->page_id)) return null;
                            return Html::a('<span class="grey-text">'.Yii::$app->params['domain'].'</span>'.$model->page->slug, Yii::$app->urlManagerFrontend->createUrl(['/page/front/view', 'slug' => $model->page->slug]), ['target' => "_blank"]);
                        }
                    ],
                    [
                        'attribute' => 'url',
                        'format' => 'url',
                    ],
                    [
                        'attribute' => 'created_at',
                        'format' => 'datetime',
                    ],
                    [
                        'class' => \uraankhayayaal\sortable\grid\Column::className(),
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
            ]); ?>
        </div>
    </div>
</div>
