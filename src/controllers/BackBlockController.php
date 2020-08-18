<?php

namespace uraankhayayaal\page\controllers;

use uraankhayayaal\materializecomponents\imgcropper\actions\UploadAction;
use uraankhayayaal\sortable\actions\Sorting;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use uraankhayayaal\page\models\PageBlock;
use uraankhayayaal\page\models\PageBlockSearch;
use vova07\imperavi\actions\GetFilesAction;
use vova07\imperavi\actions\GetImagesAction;
use vova07\imperavi\actions\UploadFileAction;
use Yii;
use yii\web\NotFoundHttpException;

class BackBlockController extends Controller
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
            'image-upload' => [
                'class' => UploadFileAction::class,
                'url' => '/images/imperavi/page-block/',
                'path' => '@frontend/web/images/imperavi/page-block/',
                'translit' => true,
            ],
            'file-upload' => [
                'class' => UploadFileAction::class,
                'url' => '/images/imperavi/page-block/',
                'path' => '@frontend/web/images/imperavi/page-block/',
                'uploadOnlyImage' => false,
                'translit' => true,
            ],
            'images-get' => [
                'class' => GetImagesAction::class,
                'url' => '/images/imperavi/page-block/',
                'path' => '@frontend/web/images/imperavi/page-block/',
                'options' => ['only' => ['*.jpg', '*.jpeg', '*.png', '*.gif', '*.ico']],
            ],
            'files-get' => [
                'class' => GetFilesAction::class,
                'url' => '/images/imperavi/page-block/',
                'path' => '@frontend/web/images/imperavi/page-block/',
                'options' => ['only' => ['*.txt', '*.md', '*.zip', '*.rar', '*.docx', '*.doc', '*.pdf', '*.xls']],
            ],
            'uploadImg' => [
                'class' => UploadAction::class,
                'url' => '/images/uploads/page-block/',
                'path' => '@frontend/web/images/uploads/page-block/',
                'maxSize' => 10485760,
            ],
            'sorting' => [
                'class' => Sorting::class,
                'query' => PageBlock::find(),
            ],
        ];
    }

    public function actionIndex($id)
    {
        $searchModel = new PageBlockSearch();
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

    public function actionCreate($page_id, $type)
    {
        $model = new PageBlock();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Запись успешно создана!');
            return $this->redirect(['back/view', 
                'id' => $page_id
            ]);
        }

        return $this->render('create', [
            'model' => $model,
            'type' => $type,
            'page_id' => $page_id,
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
        if (($model = PageBlock::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
