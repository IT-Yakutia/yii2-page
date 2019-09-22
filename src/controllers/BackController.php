<?php

namespace uraankhayayaal\page\controllers;

use Yii;
use uraankhayayaal\page\models\Page;
use uraankhayayaal\page\models\PageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class BackController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['page']
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadFileAction',
                'url' => '/images/imperavi/page/',
                'path' => '@frontend/web/images/imperavi/page/',
                'translit' => true,
            ],
            'file-upload' => [
                'class' => 'vova07\imperavi\actions\UploadFileAction',
                'url' => '/images/imperavi/page/',
                'path' => '@frontend/web/images/imperavi/page/',
                'uploadOnlyImage' => false,
                'translit' => true,
            ],
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetImagesAction',
                'url' => '/images/imperavi/page/',
                'path' => '@frontend/web/images/imperavi/page/',
                'options' => ['only' => ['*.jpg', '*.jpeg', '*.png', '*.gif', '*.ico']],
            ],
            'files-get' => [
                'class' => 'vova07\imperavi\actions\GetFilesAction',
                'url' => '/images/imperavi/page/',
                'path' => '@frontend/web/images/imperavi/page/',
                'options' => ['only' => ['*.txt', '*.md', '*.zip', '*.rar', '*.docx', '*.doc', '*.pdf', '*.xls']],
            ],
            'uploadImg' => [
                'class' => 'uraankhayayaal\materializecomponents\imgcropper\actions\UploadAction',
                'url' => '/images/uploads/page/',
                'path' => '@frontend/web/images/uploads/page/',
                'maxSize' => 10485760,
            ],
            'sorting' => [
                'class' => \uraankhayayaal\sortable\actions\Sorting::className(),
                'query' => Page::find(),
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new PageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Page();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Запись успешно создана!');
            return $this->redirect(['index']);
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
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        if($this->findModel($id)->delete() !== false)
            Yii::$app->session->setFlash('success', 'Запись успешно удалена!');
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
