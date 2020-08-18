<?php

use yii\db\Migration;

/**
 * Class m200816_112156_add_page_block
 */
class m200816_112156_add_page_block extends Migration
{

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('page_block', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'type' => $this->integer(),
            'content' => $this->text(),
            'photo' => $this->string(),

            'page_id' => $this->integer(),

            'sort' => $this->integer(),

            'is_publish' => $this->boolean(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('page_block-page-fkey', 'page_block', 'page_id', 'page', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('page_block-page-fkey', 'page_block', 'page_id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('page_block-page-fkey', 'page_block');
        $this->dropIndex('page_block-page-fkey', 'page_block');

        $this->dropTable('page_block');
    }
}
