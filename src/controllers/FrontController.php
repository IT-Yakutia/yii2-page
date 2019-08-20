<?php
namespace uraankhayayaal\page\controllers;

use Yii;
use uraankhayayaal\page\models\Page;
use yii\web\NotFoundHttpException;
use yii\web\Controller;

/**
 * Back controller
 */
class FrontController extends Controller
{
    public function actionView($slug)
    {
        $view = 'view';
        if(
            isset(Yii::$app->params['custom_view_for_modules']) && 
            isset(Yii::$app->params['custom_view_for_modules']['page_front']) && 
            isset(Yii::$app->params['custom_view_for_modules']['page_front']['view'])
        )
            $view = Yii::$app->params['custom_view_for_modules']['page_front']['view'];

        $model = $this->findModel($slug);
        return $this->render($view, [
            'model' => $model,
        ]);
    }

    protected function findModel($slug)
    {
        if (($model = Page::findOneForFront($slug)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
