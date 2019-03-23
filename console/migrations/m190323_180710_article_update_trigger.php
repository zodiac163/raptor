<?php

use yii\db\Migration;

/**
 * Class m190323_180710_article_update_trigger
 */
class m190323_180710_article_update_trigger extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "CREATE TRIGGER `article_BEFORE_UPDATE` BEFORE UPDATE ON `article` FOR EACH ROW BEGIN SET new.modified_time = current_timestamp(); END";
        $this->execute($sql);

        $sql = "CREATE TRIGGER `category_BEFORE_UPDATE` BEFORE UPDATE ON `category` FOR EACH ROW BEGIN SET new.modified_time = current_timestamp(); END";
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute('DROP TRIGGER IF EXISTS `article_BEFORE_UPDATE`');
        $this->execute('DROP TRIGGER IF EXISTS `category_BEFORE_UPDATE`');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190323_180710_article_update_trigger cannot be reverted.\n";

        return false;
    }
    */
}
