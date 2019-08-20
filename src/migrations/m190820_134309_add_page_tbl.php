<?php

use yii\db\Migration;

/**
 * Class m190820_134309_add_page_tbl
 */
class m190820_134309_add_page_tbl extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('page', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'content' => $this->text(),
            'photo' => $this->string(),
            'sort' => $this->integer(),
            'no_title' => $this->boolean()->notNull()->defaultValue(false),

            'slug' => $this->string()->notNull()->unique(),
            'user_id' => $this->integer()->notNull(),

            'is_publish' => $this->boolean(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('page');
    }
}
