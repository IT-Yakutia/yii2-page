<?php

use yii\db\Migration;

/**
 * Class m200822_115134_add_chart_type_to_page_block
 */
class m200822_115134_add_chart_type_to_page_block extends Migration
{
    public function safeUp()
    {
        $this->addColumn('page_block', 'chart_type', $this->integer());
    }

    public function safeDown()
    {
        $this->dropColumn('page_block', 'chart_type');
    }
}
