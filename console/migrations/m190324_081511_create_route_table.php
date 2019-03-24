<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%route}}`.
 */
class m190324_081511_create_route_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%route}}', [
            'id' => $this->primaryKey(),
            'alias' => $this->string(900)->notNull(),
            'route_path' => $this->string(900)->notNull(),
            'created_time' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'model_id' => $this->string(45),
            'row_id' => $this->integer(),
            'last_update' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%route}}');
    }
}
