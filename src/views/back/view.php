<?php

use yii\helpers\Html;

$this->title = 'Страница: ' . $model->title;
?>

<div class="page-view">
    <div class="row">
        <p></p>
        <div class="col s12 m12 l12 xl8">
            <?= Html::a('Редактировать страницу', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m12 l12 xl4">
            <div class="card-panel <?= $model->is_publish ? 'teal' : 'grey' ?>">
                <strong>
                    <span class="white-text">
                        <?= $model->is_publish ? 'Опубликовано' : 'Не опубликовано' ?>
                    </span>
                </strong>
            </div>
        </div>
        <div class="col s12 m12 l12 xl4">
            <div class="card-panel <?= $model->no_title ? 'teal' : 'grey' ?>">
                <strong>
                    <span class="white-text">
                        <?= $model->no_title ? 'Без заголовка' : 'C заголовком' ?>
                    </span>
                </strong>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m12 l12 xl8">
            <ul class="collection">
                <li class="collection-item">
                    <strong>
                        <p>Заголовок</p>
                    </strong>
                    <span title="Редактировать">
                        <?= Html::a($model->title, ['update', 'id' => $model->id]) ?>
                    </span>
                </li>
                <li class="collection-item">
                    <strong>
                        <p>Slug</p>
                    </strong>
                    <span title="Редактировать">
                        <?= Html::a($model->slug, ['update', 'id' => $model->id]) ?>
                    </span>
                </li>
                <li class="collection-item">
                    <strong>
                        <p>изображение</p>
                    </strong>
                    <span title="Редактировать">
                        <?php
                        $photo = $model->photo
                            ? Html::img($model->photo, ['alt' => 'page image', 'height' => '300px'])
                            : 'Добавить изображение страницы';
                        echo Html::a($photo, ['update', 'id' => $model->id]);
                        ?>
                    </span>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col s12 m12 l12 xl8">
            <?= $this->context->renderPartial('/back-block/index', [
                'page_id' => $model->id,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]) ?>
        </div>
    </div>
</div>