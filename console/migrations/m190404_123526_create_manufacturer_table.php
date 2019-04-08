<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%manufacturer}}`.
 */
class m190404_123526_create_manufacturer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%manufacturer}}', [
            'id' => $this->primaryKey(),
            'fullname' => $this->string(225)->notNull(),
            'shortname' => $this->string(45)->notNull(),
            'description' => $this->text(),
            'activity_kind' => $this->string(225),
            'address' => $this->string(225),
            'phone' => $this->string(45),
            'site' => $this->string(225),
            'mail' => $this->string(45),
            'social_networks' => $this->text(),
            'branches' => $this->text(),
            'contact_person' => $this->text(),
            'logo' => $this->string(225),
            'additional_files' => $this->text(),
            'language' => $this->char(7)->notNull()->defaultvalue('*'),
            'created_user_id' => $this->integer()->notNull(),
            'created_time' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'modified_user_id' => $this->integer(),
            'modified_time' => $this->timestamp()->defaultValue(NULL),
        ]);
        
        $this->createIndex(
            'man_create_user_idx',
            'manufacturer',
            'created_user_id'
        );
        
        $this->createIndex(
            'man_upd_user_idx',
            'manufacturer',
            'modified_user_id'
        );
        
        $this->addForeignKey(
            'man_create_user',
            'manufacturer',
            'created_user_id',
            'user',
            'id',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'man_upd_user',
            'manufacturer',
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
        $this->dropTable('{{%manufacturer}}');
    }
}
