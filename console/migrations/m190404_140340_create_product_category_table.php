<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_category}}`.
 */
class m190404_140340_create_product_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_category}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(45)->notNull(),
            'description' => $this->string(255)->notNull(),
            'parent_id' => $this->integer(),
            'language' => $this->char(7)->notNull()->defaultValue('*'),
            'created_user_id' => $this->integer()->notNull(),
            'created_time' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'modified_user_id' => $this->integer(),
            'modified_time' => $this->timestamp(),
        ]);
        
        $this->addForeignKey(
            'prod_cat_create_user',
            'product_category',
            'created_user_id',
            'user',
            'id',
            'CASCADE'
        );
                
        $this->addForeignKey(
            'prod_cat_upd_user',
            'product_category',
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
        $this->dropTable('{{%product_category}}');
    }
}
