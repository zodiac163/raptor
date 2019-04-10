<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%jornal_knowledge_base}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%jornal}}`
 * - `{{%knowledge_base}}`
 */
class m190408_110132_create_junction_table_for_journal_and_knowledge_base_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%journal_knowledge_base}}', [
            'id' => $this->primaryKey(),
            'journal_id' => $this->integer(),
            'knowledge_base_id' => $this->integer()
        ]);

        // creates index for column `jornal_id`
        $this->createIndex(
            '{{%idx-journal_knowledge_base-journal_id}}',
            '{{%journal_knowledge_base}}',
            'journal_id'
        );

        // add foreign key for table `{{%jornal}}`
        $this->addForeignKey(
            '{{%fk-journal_knowledge_base-journal_id}}',
            '{{%journal_knowledge_base}}',
            'journal_id',
            '{{%journal}}',
            'id',
            'CASCADE'
        );

        // creates index for column `knowledge_base_id`
        $this->createIndex(
            '{{%idx-journal_knowledge_base-knowledge_base_id}}',
            '{{%journal_knowledge_base}}',
            'knowledge_base_id'
        );

        // add foreign key for table `{{%knowledge_base}}`
        $this->addForeignKey(
            '{{%fk-journal_knowledge_base-knowledge_base_id}}',
            '{{%journal_knowledge_base}}',
            'knowledge_base_id',
            '{{%knowledge_base}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%journal}}`
        $this->dropForeignKey(
            '{{%fk-journal_knowledge_base-journal_id}}',
            '{{%journal_knowledge_base}}'
        );

        // drops index for column `journal_id`
        $this->dropIndex(
            '{{%idx-journal_knowledge_base-journal_id}}',
            '{{%journal_knowledge_base}}'
        );

        // drops foreign key for table `{{%knowledge_base}}`
        $this->dropForeignKey(
            '{{%fk-journal_knowledge_base-knowledge_base_id}}',
            '{{%journal_knowledge_base}}'
        );

        // drops index for column `knowledge_base_id`
        $this->dropIndex(
            '{{%idx-journal_knowledge_base-knowledge_base_id}}',
            '{{%journal_knowledge_base}}'
        );

        $this->dropTable('{{%journal_knowledge_base}}');
    }
}
