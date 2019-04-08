<?php

use yii\db\Migration;

/**
 * Class m190408_071229_update_product_category_table
 */
class m190408_071229_update_product_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "CREATE TRIGGER `product_category_BEFORE_UPDATE` BEFORE UPDATE ON `product_category` FOR EACH ROW BEGIN SET new.modified_time = current_timestamp(); END";
        $this->execute($sql);
        $sql = "CREATE TRIGGER `product_BEFORE_UPDATE` BEFORE UPDATE ON `product` FOR EACH ROW BEGIN SET new.modified_time = current_timestamp(); END";
        $this->execute($sql);
        $sql = "CREATE TRIGGER `manufacturer_BEFORE_UPDATE` BEFORE UPDATE ON `manufacturer` FOR EACH ROW BEGIN SET new.modified_time = current_timestamp(); END";
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute('DROP TRIGGER IF EXISTS `product_category_BEFORE_UPDATE`');
        $this->execute('DROP TRIGGER IF EXISTS `product_BEFORE_UPDATE`');
        $this->execute('DROP TRIGGER IF EXISTS `manufacturer_BEFORE_UPDATE`');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190408_071229_update_product_category_table cannot be reverted.\n";

        return false;
    }
    */
}
