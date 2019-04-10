<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%journal}}`.
 */
class m190408_105239_create_journal_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%journal}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'date' => $this->date()->notNull(),
            'image'=> $this->string(255)->notNull(),
            'description' => $this->string(1024)->notNull(),
            'hits' => $this->integer()->defaultValue(0),
            'language' => $this->char(7)->defaultValue('*'),
            'created_user_id' => $this->integer()->notNull(),
            'created_time' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'modified_user_id' => $this->integer(),
            'modified_time' => $this->timestamp(),
        ]);
        
        $this->addForeignKey(
            'journal_creator',
            'journal',
            'created_user_id',
            'user',
            'id',
            'CASCADE'
        );
                
        $this->addForeignKey(
            'journal_upd',
            'journal',
            'modified_user_id',
            'user',
            'id',
            'CASCADE'
        );
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%journal}}');
    }
}
