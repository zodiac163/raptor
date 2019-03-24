<?php

use yii\db\Migration;

/**
 * Class m190324_100035_route_update_trigger
 */
class m190324_100035_route_update_trigger extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "CREATE TRIGGER `route_BEFORE_UPDATE` BEFORE UPDATE ON `route` FOR EACH ROW BEGIN SET new.last_update = current_timestamp(); END";
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute('DROP TRIGGER IF EXISTS `route_BEFORE_UPDATE`');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190324_100035_route_update_trigger cannot be reverted.\n";

        return false;
    }
    */
}
