<?php

namespace uraankhayayaal\page\controllers;

use uraankhayayaal\materializecomponents\imgcropper\actions\UploadAction;
use uraankhayayaal\sortable\actions\Sorting;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use uraankhayayaal\page\models\PageBlock;
use uraankhayayaal\page\models\PageBlockFaq;
use uraankhayayaal\page\models\PageBlockFaqSearch;
use vova07\imperavi\actions\GetFilesAction;
use vova07\imperavi\actions\GetImagesAction;
use vova07\imperavi\actions\UploadFileAction;
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
            'image-upload' => [
                'class' => UploadFileAction::class,
                'url' => '/images/imperavi/page-block-faq/',
                'path' => '@frontend/web/images/imperavi/page-block-faq/',
                'translit' => true,
            ],
            'file-upload' => [
                'class' => UploadFileAction::class,
                'url' => '/images/imperavi/page-block-faq/',
                'path' => '@frontend/web/images/imperavi/page-block-faq/',
                'uploadOnlyImage' => false,
                'translit' => true,
            ],
            'images-get' => [
                'class' => GetImagesAction::class,
                'url' => '/images/imperavi/page-block-faq/',
                'path' => '@frontend/web/images/imperavi/page-block-faq/',
                'options' => ['only' => ['*.jpg', '*.jpeg', '*.png', '*.gif', '*.ico']],
            ],
            'files-get' => [
                'class' => GetFilesAction::class,
                'url' => '/images/imperavi/page-block-faq/',
                'path' => '@frontend/web/images/imperavi/page-block-faq/',
                'options' => ['only' => ['*.txt', '*.md', '*.zip', '*.rar', '*.docx', '*.doc', '*.pdf', '*.xls']],
            ],
            'uploadImg' => [
                'class' => UploadAction::class,
                'url' => '/images/uploads/page-block-faq/',
                'path' => '@frontend/web/images/uploads/page-block-faq/',
                'maxSize' => 10485760,
            ],
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
