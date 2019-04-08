<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m190404_152901_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->text()->notNull(),
            'alias' => $this->string(95)->notNull(),
            'manufacturer_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'images' => $this->text(),
            'featured' => $this->tinyinteger(1)->notNull(),
            'ordering' => $this->integer()->notNull(),
            'published' => $this->integer()->notNull(),
            'hits' => $this->integer()->notNull(),
            'metadata' => $this->text(),
            'manufacturer_link' => $this->string(255),
            'video_link' => $this->text(),
            'code' => $this->string(45),
            'specifications' => $this->text(),
            'additional_equipment' => $this->text(),
            'language' => $this->char(7)->notNull()->defaultValue('*'),
            'created_user_id' => $this->integer()->notNull(),
            'created_time' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'modified_user_id' => $this->integer(),
            'modified_time' => $this->timestamp(),
        ]);
        
        $this->addForeignKey(
            'man_id',
            'product',
            'manufacturer_id',
            'manufacturer',
            'id',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'cat_id',
            'product',
            'category_id',
            'product_category',
            'id',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'prod_create_user',
            'product',
            'created_user_id',
            'user',
            'id',
            'CASCADE'
        );
                
        $this->addForeignKey(
            'prod_upd_user',
            'product',
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
        $this->dropTable('{{%product}}');
    }
}
