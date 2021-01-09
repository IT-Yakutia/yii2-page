<?php

use uraankhayayaal\materializecomponents\grid\MaterialActionColumn;
use uraankhayayaal\page\models\PageBlock;
use yii\helpers\Html;
use yii\grid\GridView;
use uraankhayayaal\sortable\grid\Column;
use yii\grid\SerialColumn;
use yii\widgets\LinkPager;
use yii\helpers\Url;

?>

<div class="page-block">
    <div class="row">
        <div class="col s12">
            <?= Html::a('Новый блок текста', ['back-block/create', 'page_id' => $page_id, 'type' => PageBlock::RAW_TEXT_TYPE,], ['class' => 'btn-small btn-success waves-effect waves-light']) ?>
            <?= Html::a('Новый блок графиков', ['back-block/create', 'page_id' => $page_id, 'type' => PageBlock::CHART_TYPE], ['class' => 'btn-small btn-success waves-effect waves-light']) ?>
            <?= Html::a('Новый блок галереи', ['back-block/create', 'page_id' => $page_id, 'type' => PageBlock::GALLERY_TYPE], ['class' => 'btn-small btn-success waves-effect waves-light']) ?>
            <p></p>
            <?= Html::a('Новый блок FAQ', ['back-block/create', 'page_id' => $page_id, 'type' => PageBlock::FAQ_TYPE], ['class' => 'btn-small btn-success waves-effect waves-light']) ?>
            <?= Html::a('Новый блок изображения', ['back-block/create', 'page_id' => $page_id, 'type' => PageBlock::IMAGE_TEXT_TYPE], ['class' => 'btn-small btn-success waves-effect waves-light']) ?>

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
                        'sortable-url' => Url::toRoute(['sorting_block']),
                    ]
                ],
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => SerialColumn::class],
                    [
                        'class' => MaterialActionColumn::class, 'template' => '{updateBlock}',
                        'buttons' => [
                            'updateBlock' => function ($url, $model, $key) {
                                $options = array_merge([
                                    'title' => Yii::t('app', 'Обновить блок'),
                                    'aria-label' => Yii::t('app', 'Обновить блок'),
                                    'data-pjax' => '0',
                                ]);
                                $icon = Html::tag('i', 'create', ['class' => "material-icons"]);
                                $url = ['back-block/update', 'id' => $model->id];

                                return Html::a($icon, $url, $options);
                            }
                        ]
                    ],
                    [
                        'attribute' => 'title',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Html::a($model->title, ['back-block/update', 'id' => $model->id]);
                        }
                    ],
                    [
                        'attribute' => 'type',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return '<p>' . PageBlock::TYPE_NAMES[$model->type] . '</p>';
                        }
                    ],
                    [
                        'attribute' => 'is_publish',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return $model->is_publish
                                ? '<i class="material-icons green-text">done</i>'
                                : '<i class="material-icons red-text">clear</i>';
                        },
                        'filter' => [0 => 'Нет', 1 => 'Да'],
                    ],
                    [
                        'attribute' => 'created_at',
                        'format' => 'datetime',
                    ],
                    [
                        'class' => MaterialActionColumn::class,
                        'template' => '{deleteBlock}',
                        'buttons' => [
                            'deleteBlock' => function ($url, $model, $key) {
                                $options = array_merge([
                                    'title' => Yii::t('app', 'Удалить блок'),
                                    'aria-label' => Yii::t('app', 'Удалить блок'),
                                    'data-pjax' => '0',
                                    'data' => [
                                        'method' => 'post',
                                        'params' => ['id' => $model->id],
                                    ]
                                ]);
                                $icon = Html::tag('i', 'delete', ['class' => "material-icons"]);
                                $url = ['back-block/delete'];

                                return Html::a($icon, $url, $options);
                            }
                        ]
                    ],
                    [
                        'class' => Column::class,
                    ],
                ],
                'pager' => [
                    'class' => LinkPager::class,
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