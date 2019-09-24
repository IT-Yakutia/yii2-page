<?php

use yii\db\Migration;

/**
 * Class m190924_021823_add_menu
 */
class m190924_021823_add_menu extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('page_menu', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'key' => $this->string(),

            'is_publish' => $this->boolean(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('page_menu-key-idx','page_menu','key');

        $this->createTable('page_menu_item', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),

            'url' => $this->string(),

            'user_id' => $this->integer()->notNull(),
            'page_menu_id' => $this->integer()->notNull(),
            'page_id' => $this->integer(),
            'sort' => $this->integer(),
            'parent_id' => $this->integer(),

            'is_publish' => $this->boolean(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('page_menu_item-page_menu-fkey','page_menu_item','page_menu_id','page_menu','id','CASCADE','CASCADE');
        $this->createIndex('page_menu_item-page_menu-idx','page_menu_item','page_menu_id');

        $this->addForeignKey('page_menu_item-page-fkey','page_menu_item','page_id','page','id','CASCADE','CASCADE');
        $this->createIndex('page_menu_item-page-idx','page_menu_item','page_id');

        $this->addForeignKey('page_menu_item-parent-fkey','page_menu_item','parent_id','page_menu_item','id','SET NULL','SET NULL');
        $this->createIndex('page_menu_item-parent-idx','page_menu_item','parent_id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('page_menu_item-parent-fkey','page_menu_item');
        $this->dropIndex('page_menu_item-parent-idx','page_menu_item');

        $this->dropIndex('page_menu-key-idx','page_menu');

        $this->dropForeignKey('page_menu_item-page-fkey','page_menu_item');
        $this->dropIndex('page_menu_item-page-idx','page_menu_item');

        $this->dropForeignKey('page_menu_item-page_menu-fkey','page_menu_item');
        $this->dropIndex('page_menu_item-page_menu-idx','page_menu_item');

        $this->dropTable('page_menu_item');

        $this->dropTable('page_menu');
    }
}
