<?php

use yii\db\Migration;

/**
 * Class m200923_133109_add_page_block_chart_label
 */
class m200923_133109_add_page_block_chart_label extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('page_block_chart_label', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),

            'block_id' => $this->integer(),

            'sort' => $this->integer(),

            'is_publish' => $this->boolean(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('page_block_chart_label-page_block-fkey', 'page_block_chart_label', 'block_id', 'page_block', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('page_block_chart_label-page_block-idx', 'page_block_chart_label', 'block_id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('page_block_chart_label-page_block-fkey', 'page_block_chart_label');
        $this->dropIndex('page_block_chart_label-page_block-idx', 'page_block_chart_label');
        
        $this->dropTable('page_block_chart_label');
    }
}
