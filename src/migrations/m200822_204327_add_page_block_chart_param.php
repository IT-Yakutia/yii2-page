<?php

use yii\db\Migration;

/**
 * Class m200822_204327_add_page_block_chart_param
 */
class m200822_204327_add_page_block_chart_param extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('page_block_chart_param', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'value' => $this->float(),
            'color' => $this->string(),

            'chart_id' => $this->integer(),

            'sort' => $this->integer(),

            'is_publish' => $this->boolean(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('page_block_chart_param-page_block_chart-fkey', 'page_block_chart_param', 'chart_id', 'page_block_chart', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('page_block_chart_param-page_block_chart-idx', 'page_block_chart_param', 'chart_id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('page_block_chart_param-page_block_chart-fkey', 'page_block_chart_param');
        $this->dropIndex('page_block_chart_param-page_block_chart-idx', 'page_block_chart_param');
        
        $this->dropTable('page_block_chart_param');
    }
}
