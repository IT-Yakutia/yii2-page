<?php

namespace uraankhayayaal\page\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use uraankhayayaal\page\models\PageMenu;
use uraankhayayaal\page\models\PageMenuItem;
use uraankhayayaal\page\models\PageMenuItemSearch;
use uraankhayayaal\sortable\actions\Sorting;

class BackMenuItemController extends Controller
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
            'sorting' => [
                'class' => Sorting::className(),
                'query' => PageMenuItem::find(),
            ],
        ];
    }

    public function actionIndex($page_menu_id, $menu_item_id = null)
    {
        $page_menu = $this->findPageMenuModel($page_menu_id);

        $searchModel = new PageMenuItemSearch();
        $searchModel->parent_id = $menu_item_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $page_menu->id);

        Url::remember();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'page_menu' => $page_menu,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate($page_menu_id, $menu_item_id = null)
    {
        $model = new PageMenuItem();
        $page_menu = $this->findPageMenuModel($page_menu_id);
        $model->page_menu_id = $page_menu->id;
        $model->parent_id = $menu_item_id;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Запись успешно создана!');
            return $this->redirect(Url::previous());
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
            return $this->redirect(Url::previous());
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->delete() !== false)
            Yii::$app->session->setFlash('success', 'Запись успешно удалена!');
        return $this->redirect(Url::previous());
    }

    protected function findModel($id)
    {
        if (($model = PageMenuItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findPageMenuModel($page_menu_id)
    {
        if (($model = PageMenu::findOne($page_menu_id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
