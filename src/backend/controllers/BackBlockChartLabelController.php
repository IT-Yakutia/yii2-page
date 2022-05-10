<?php

namespace uraankhayayaal\page\backend\controllers;

use uraankhayayaal\page\models\PageBlock;
use uraankhayayaal\page\models\PageBlockChartLabel;
use uraankhayayaal\page\models\PageBlockChartLabelSearch;
use uraankhayayaal\page\models\PageBlockChartParam;
use uraankhayayaal\page\models\PageBlockChartParamSearch;
use uraankhayayaal\sortable\actions\Sorting;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class BackBlockChartLabelController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'permissions' => ['page']
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
                'query' => PageBlockChartLabel::find(),
            ],
        ];
    }

    public function actionIndex($block_id)
    {
        $model = PageBlock::findOne($block_id);
        $searchModel = new PageBlockChartLabelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $block_id);

        return $this->render('index', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate($block_id)
    {
        $model = new PageBlockChartLabel();
        $model->block_id = $block_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Запись успешно создана!');
            return $this->redirect([
                'index',
                'block_id' => $block_id
            ]);
        }

        return $this->render('create', [
            'model' => $model,
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
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $block_id = $model->block_id;

        if ($model->delete() !== false)
            Yii::$app->session->setFlash('success', 'Запись успешно удалена!');
        return $this->redirect([
            'index',
            'block_id' => $block_id
        ]);
    }

    protected function findModel($id)
    {
        if (($model = PageBlockChartLabel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}