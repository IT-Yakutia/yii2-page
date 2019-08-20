<?php

namespace uraankhayayaal\page;

use yii\web\UrlRuleInterface;
use yii\base\BaseObject;

class PageUrlRule extends BaseObject implements UrlRuleInterface
{

    public function createUrl($manager, $route, $params)
    {
        if ($route === 'page/front/view') {
            if (isset($params['slug'])) {
                return $params['slug'];
            }
        }
        return false;  // данное правило не применимо
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        $items = explode( "/" , $pathInfo );
        if(empty($items[0])) return false;

        $unique_items = [];
        foreach ($items as $key => $slug) {
            if(!in_array($slug, $unique_items)) 
                $unique_items[] = $slug;
            else 
                continue;
            if(\uraankhayayaal\page\models\Page::find()->where(['slug' => $slug, 'is_publish' => true])->count() == 0) return false;
        }

        return ['page/front/view', ['slug' => $slug]];
    }
}
?>