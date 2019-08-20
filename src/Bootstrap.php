<?php

namespace uraankhayayaal\page;

use Yii;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface{

    //Метод, который вызывается автоматически при каждом запросе
    public function bootstrap($app)
    {
        /*
         * Регистрация модуля в приложении
         * вместо указания в файле frontend/config/main.php
         */
        $app->setModule('page', 'uraankhayayaal\page\Module');

        //Правила маршрутизации
        $app->getUrlManager()->addRules([
            [
                'class' => '\uraankhayayaal\page\PageUrlRule',
            ],
        ], false);

        /* It`s need to sitemap generating */
        // $app->set('urlManagerFrontend', [
        //     'class' => 'yii\web\UrlManager',
        //     'baseUrl' => $app->params['domain'],
        //     'enablePrettyUrl' => true,
        //     'enableStrictParsing' => true,
        //     'showScriptName' => false,
        //     'rules' => [
        //         'blog' => 'blog/front/index',
        //         'blog/<action:\w+>/<id:\d+>' => 'blog/front/<action>',
                
        //         '<slug>' => 'page/front/view',

        //         '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
        //         '<module:\w+>/<controller:\w+>/<action:\w+>/' => '<module>/<controller>/<action>',
        //     ],
        // ]);
    }
}