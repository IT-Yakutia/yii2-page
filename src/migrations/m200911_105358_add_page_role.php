<?php

use yii\db\Migration;

/**
 * Class m200911_105358_add_page_role
 */
class m200911_105358_add_page_role extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $pageRedactor = $auth->getPermission('page');
        if($pageRedactor == null){
            $pageRedactor = $auth->createPermission('page');
            $pageRedactor->description = 'Редактирование страниц';

            $auth->add($pageRedactor);

            $operator = $auth->getRole('operator');
            if($operator != null || $operator != false)
                $auth->addChild($operator,$pageRedactor);
        }
    }

    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        $pageRedactor = $auth->getPermission('page');
        if($pageRedactor !== null)
            $auth->remove($pageRedactor);
        
    }
}
