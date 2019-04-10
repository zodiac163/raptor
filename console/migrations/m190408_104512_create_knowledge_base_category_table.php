<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%knowledge_base_category}}`.
 */
class m190408_104512_create_knowledge_base_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%knowledge_base_category}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->notNull()->defaultValue(0),
            'level' => $this->integer()->notNull()->defaultValue(1),
            'path' => $this->string(400)->notNull(),
            'alias' => $this->string(400),
            'title' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'published' => $this->boolean()->defaultValue(1),
            'params' => $this->text(),
            'metadata' => $this->text(),
            'language' => $this->char(7)->defaultValue('*'),
            'created_user_id' => $this->integer()->notNull(),
            'created_time' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'modified_user_id' => $this->integer(),
            'modified_time' => $this->timestamp()
        ]);
        
        $this->insert('knowledge_base_category',array(
            'path'=>'root',
            'alias' => 'root',
            'title' => 'root',
            'description' => 'Основная',
            'published' => 1,
            'created_user_id' => 1,
            'parent_id' => '1',
        ));
        
        $this->addForeignKey(
            'know_cat_create_user',
            'knowledge_base_category',
            'created_user_id',
            'user',
            'id',
            'CASCADE'
        );
                
        $this->addForeignKey(
            'know_cat_upd_user',
            'knowledge_base_category',
            'modified_user_id',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'know_cat_parent',
            'knowledge_base_category',
            'parent_id',
            'knowledge_base_category',
            'id',
            'CASCADE'
        );
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%knowledge_base_category}}');
    }
}
