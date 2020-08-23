<?php

namespace uraankhayayaal\page\controllers;

use uraankhayayaal\page\models\PageBlock;
use uraankhayayaal\page\models\PageBlockChart;
use uraankhayayaal\page\models\PageBlockChartParam;
use uraankhayayaal\page\models\PageBlockChartParamSearch;
use uraankhayayaal\page\models\PageBlockChartSearch;
use uraankhayayaal\sortable\actions\Sorting;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class BackBlockChartParamController extends Controller
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
                'query' => PageBlockChartParam::find(),
            ],
        ];
    }

    public function actionIndex($chart_id)
    {
        $model = PageBlockChart::findOne($chart_id);
        $searchModel = new PageBlockChartParamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $chart_id);

        return $this->render('index', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate($chart_id)
    {
        $model = new PageBlockChartParam();
        $model->chart_id = $chart_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Запись успешно создана!');
            return $this->redirect([
                'index',
                'chart_id' => $chart_id
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
                'chart_id' => $model->chart_id
            ]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $chart_id = $model->chart_id;

        if ($model->delete() !== false)
            Yii::$app->session->setFlash('success', 'Запись успешно удалена!');
        return $this->redirect([
            'index',
            'chart_id' => $chart_id
        ]);
    }

    protected function findModel($id)
    {
        if (($model = PageBlockChartParam::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}