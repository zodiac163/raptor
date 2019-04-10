<?php

use yii\db\Migration;

/**
 * Class m190409_050236_update_triggers_for_knowledge_base
 */
class m190409_050236_update_triggers_for_knowledge_base extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "CREATE TRIGGER `knowledge_base_category_BEFORE_UPDATE` BEFORE UPDATE ON `knowledge_base_category` FOR EACH ROW BEGIN SET new.modified_time = current_timestamp(); END";
        $this->execute($sql);
        $sql = "CREATE TRIGGER `knowledge_base_BEFORE_UPDATE` BEFORE UPDATE ON `knowledge_base` FOR EACH ROW BEGIN SET new.modified_time = current_timestamp(); END";
        $this->execute($sql);
        $sql = "CREATE TRIGGER `journal_BEFORE_UPDATE` BEFORE UPDATE ON `journal` FOR EACH ROW BEGIN SET new.modified_time = current_timestamp(); END";
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute('DROP TRIGGER IF EXISTS `knowledge_base_category_BEFORE_UPDATE`');
        $this->execute('DROP TRIGGER IF EXISTS `knowledge_base_BEFORE_UPDATE`');
        $this->execute('DROP TRIGGER IF EXISTS `journal_BEFORE_UPDATE`');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190409_050236_update_triggers_for_knowledge_base cannot be reverted.\n";

        return false;
    }
    */
}
