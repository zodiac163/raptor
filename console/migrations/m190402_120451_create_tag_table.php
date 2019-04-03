<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tag}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m190402_120451_create_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tag}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(20),
            'created_user_id' => $this->integer()->notNull(),
            'category_id' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        // creates index for column `created_user_id`
        $this->createIndex(
            '{{%idx-tag-created_user_id}}',
            '{{%tag}}',
            'created_user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-tag-created_user_id}}',
            '{{%tag}}',
            'created_user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-tag-created_user_id}}',
            '{{%tag}}'
        );

        // drops index for column `created_user_id`
        $this->dropIndex(
            '{{%idx-tag-created_user_id}}',
            '{{%tag}}'
        );

        $this->dropTable('{{%tag}}');
    }
}
