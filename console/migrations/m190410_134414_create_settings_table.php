<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%jornal}}`.
 */
class m190410_134414_create_settings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%settings}}', [
            'id' => $this->primaryKey(),
            'sys_title' => $this->string(99)->notNull(),
            'sys_state' => $this->tinyInteger(1)->notNull()->defaultValue(1),
            'sys_slogan' => $this->string(255),
            'sys_description' => $this->string(1024),
            'sys_logo' => $this->string(1024),
            'sys_footer' => $this->string(1024),
            'adm_mail' => $this->string(99),
            'seo_description' => $this->string(1024),
            'seo_keywords' => $this->string(1024),
        ]);
        
        $this->insert('settings', array(
            'sys_title' => 'title',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%settings}}');
    }
}
