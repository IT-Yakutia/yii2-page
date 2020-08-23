<?php

use yii\db\Migration;

/**
 * Class m200822_192827_add_page_block_chart
 */
class m200822_192827_add_page_block_chart extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('page_block_chart', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'value' => $this->float(),
            'color' => $this->string(),

            'block_id' => $this->integer(),

            'sort' => $this->integer(),

            'is_publish' => $this->boolean(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('page_block_chart-page_block-fkey', 'page_block_chart', 'block_id', 'page_block', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('page_block_chart-page_block-idx', 'page_block_chart', 'block_id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('page_block_chart-page_block-fkey', 'page_block_chart');
        $this->dropIndex('page_block_chart-page_block-idx', 'page_block_chart');
        
        $this->dropTable('page_block_chart');
    }
}
