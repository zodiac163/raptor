<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%menu}}`.
 */
class m190325_063205_create_menu_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%menu}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(35)->notNull(),
            'published' => $this->boolean()->defaultValue(1),
            'language' => $this->char(7)->defaultValue('*'),
            'created_user_id' => $this->integer()->notNull(),
            'created_time' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'modified_user_id' => $this->integer(),
            'modified_time' => $this->timestamp()
        ]);

        $this->createTable('{{%menu_links}}', [
            'id' => $this->primaryKey(),
            'menu_id' => $this->integer()->notNull(),
            'title' => $this->string(35)->notNull(),
            'link' => $this->string(1024)->notNull(),
            'parent_id' => $this->integer()->defaultValue(0),
            'published' => $this->boolean()->defaultValue(1),
            'language' => $this->char(7)->defaultValue('*'),
            'created_user_id' => $this->integer()->notNull(),
            'created_time' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'modified_user_id' => $this->integer(),
            'modified_time' => $this->timestamp()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%menu_links}}');
        $this->dropTable('{{%menu}}');
    }
}
