<?php

use yii\db\Migration;

/**
 * Class m190324_083155_route_index
 */
class m190324_083155_route_index extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "ALTER TABLE `route` ADD INDEX `route_alias` (`alias`);";
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute('ALTER TABLE `route` DROP INDEX `route_alias`');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190324_083155_route_index cannot be reverted.\n";

        return false;
    }
    */
}
