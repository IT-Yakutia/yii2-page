<?php

namespace uraankhayayaal\page\controllers;

use uraankhayayaal\sortable\actions\Sorting;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use uraankhayayaal\page\models\PageBlock;
use uraankhayayaal\page\models\PageBlockFaq;
use uraankhayayaal\page\models\PageBlockFaqSearch;
use Yii;
use yii\web\NotFoundHttpException;

class BackBlockFaqController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['page']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST']
                ]
            ]
        ];
    }

    public function actions()
    {
        return [
            'sorting' => [
                'class' => Sorting::class,
                'query' => PageBlock::find(),
            ],
        ];
    }

    public function actionIndex($block_id)
    {
        $searchModel = new PageBlockFaqSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $block_id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'block_id' => $block_id
        ]);
    }

    public function actionCreate($block_id)
    {
        $model = new PageBlockFaq();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Запись успешно создана!');
            return $this->redirect([
                'index',
                'block_id' => $block_id
            ]);
        }

        return $this->render('create', [
            'model' => $model,
            'block_id' => $block_id,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Запись успешно изменена!');
            return $this->redirect([
                'index',
                'block_id' => $model->block_id
            ]);
        }

        return $this->render('update', [
            'model' => $model,
            'block_id' => $model->block_id
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $block_id = $model->block_id;

        if ($this->findModel($id)->delete() !== false) {
            Yii::$app->session->setFlash('success', 'Запись успешно удалена!');
            return $this->redirect([
                'index',
                'block_id' => $block_id
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = PageBlockFaq::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
