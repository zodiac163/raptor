<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tag_article}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%tag}}`
 * - `{{%article}}`
 */
class m190402_122342_create_junction_table_for_tag_and_article_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tag_article}}', [
            'id' => $this->primaryKey(),
            'tag_id' => $this->integer(),
            'article_id' => $this->integer(),
        ]);

        // creates index for column `tag_id`
        $this->createIndex(
            '{{%idx-tag_article-tag_id}}',
            '{{%tag_article}}',
            'tag_id'
        );

        // add foreign key for table `{{%tag}}`
        $this->addForeignKey(
            '{{%fk-tag_article-tag_id}}',
            '{{%tag_article}}',
            'tag_id',
            '{{%tag}}',
            'id',
            'CASCADE'
        );

        // creates index for column `article_id`
        $this->createIndex(
            '{{%idx-tag_article-article_id}}',
            '{{%tag_article}}',
            'article_id'
        );

        // add foreign key for table `{{%article}}`
        $this->addForeignKey(
            '{{%fk-tag_article-article_id}}',
            '{{%tag_article}}',
            'article_id',
            '{{%article}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%tag}}`
        $this->dropForeignKey(
            '{{%fk-tag_article-tag_id}}',
            '{{%tag_article}}'
        );

        // drops index for column `tag_id`
        $this->dropIndex(
            '{{%idx-tag_article-tag_id}}',
            '{{%tag_article}}'
        );

        // drops foreign key for table `{{%article}}`
        $this->dropForeignKey(
            '{{%fk-tag_article-article_id}}',
            '{{%tag_article}}'
        );

        // drops index for column `article_id`
        $this->dropIndex(
            '{{%idx-tag_article-article_id}}',
            '{{%tag_article}}'
        );

        $this->dropTable('{{%tag_article}}');
    }
}
