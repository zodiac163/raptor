<?php

use yii\db\Migration;

/**
 * Class m190410_114528_seed_for_table_product_category
 */
class m190410_114528_seed_for_table_product_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->delete('product_category');
        $this->insert('product_category',array(
            'id' => 1,
            'title' => 'root',
            'description' => 'Основная',
            'created_user_id' => 1,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190410_114528_seed_for_table_product_category deleted from migration list.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190410_114528_seed_for_table_product_category cannot be reverted.\n";

        return false;
    }
    */
}
