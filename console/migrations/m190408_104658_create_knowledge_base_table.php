<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%knowledge_base}}`.
 */
class m190408_104658_create_knowledge_base_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%knowledge_base}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'path' => $this->string(400)->notNull(),
            'introtext' => $this->string(1000)->notNull()->comment('Анонс'),
            'fulltext' => $this->text()->notNull()->comment('Полный текст'),
            'cat_id' => $this->integer(),
            'images' => $this->text()->comment('Набор картинок для превью'),
            'featured' => $this->tinyInteger(3)->defaultValue(0)->comment('Избранное'),
            'ordering' => $this->integer()->notNull()->comment('Сортировка'),
            'published' => $this->boolean()->notNull()->defaultValue(1),
            'hits' => $this->integer()->defaultValue(0)->comment('Коичество показов статьи'),
            'metadata' => $this->text(),
            'language' => $this->char(7)->defaultValue('*'),
            'created_user_id' => $this->integer()->notNull(),
            'created_time' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'modified_user_id' => $this->integer(),
            'modified_time' => $this->timestamp()
        ]);
        
        $this->addForeignKey(
            'know_create_user',
            'knowledge_base',
            'created_user_id',
            'user',
            'id',
            'CASCADE'
        );
                
        $this->addForeignKey(
            'know_upd_user',
            'knowledge_base',
            'modified_user_id',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'know_base_category',
            'knowledge_base',
            'cat_id',
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
        $this->dropTable('{{%knowledge_base}}');
    }
}
