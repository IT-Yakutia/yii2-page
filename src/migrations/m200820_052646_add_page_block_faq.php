<?php

use yii\db\Migration;

/**
 * Class m200820_052646_add_page_block_faq
 */
class m200820_052646_add_page_block_faq extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('page_block_faq', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'content' => $this->text(),

            'block_id' => $this->integer(),

            'sort' => $this->integer(),

            'is_publish' => $this->boolean(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('page_block_faq-page_block-fkey', 'page_block_faq', 'block_id', 'page_block', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('page_block_faq-page_block-idx', 'page_block_faq', 'block_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('page_block_faq-page_block-fkey', 'page_block_faq');
        $this->dropIndex('page_block_faq-page_block-idx', 'page_block_faq');

        $this->dropTable('page_block_faq');
    }
}
