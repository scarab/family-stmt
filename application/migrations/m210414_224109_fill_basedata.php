<?php

use app\models\source\citibank\CitibankCsvSource;
use yii\db\Migration;

/**
 * Class m210414_224109_fill_basedata
 */
class m210414_224109_fill_basedata extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('source', [
            'name' => 'CitibankSource',
            'class' => CitibankCsvSource::class,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('source');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210414_224109_fill_basedata cannot be reverted.\n";

        return false;
    }
    */
}
