<?php

use yii\db\Migration;

/**
 * Class m210107_193231_init
 */
class m210107_193231_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // Источники данных
        $this->createTable('{{%source}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique()->comment('Название источника данных (банк)'),
            'class' => $this->string()->notNull()->comment('Класс источника данных'),
        ], $tableOptions);

        // Категории данных
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey()->notNull(),
            'name' => $this->string(),
            'parentId' => $this->integer(),
        ], $tableOptions);
        $this->addForeignKey(
            'fk_category_parent_id',
            '{{%category}}',
            'parentId',
            '{{%category}}',
            'id',
            'CASCADE'
        );

        // Правила обработки
        $this->createTable('{{%rule}}', [
            'id' => $this->primaryKey(),
            'class' => $this->string()->notNull(),
            'data' => $this->json(),
            'categoryId' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->addForeignKey(
            'fk_rule_category',
            '{{%rule}}',
            'categoryId',
            '{{%category}}',
            'id',
            'CASCADE'
        );

        // Транзакции
        $this->createTable('{{%transaction}}', [
            'id' => $this->primaryKey(),
            '_transactionDate' => $this->dateTime()->notNull()->comment('Дата-время транзакции по данным банка'),
            'place' => $this->string()->comment('Место совершения транзакции по данным банка'),
            'amount' => $this->float()->notNull()->comment('Сумма транзакции'),
            'currency' => $this->string(3)->comment('Валюта транзакции'),
            '_loadDate' => $this->dateTime()->notNull()->comment('Дата-время загрузки транзакции'),
            'categoryId' => $this->integer()->comment('Указатель на категорию транзакции'),
            '_exportDate' => $this->dateTime()->comment('Дата-время выгрузки во внешний файл данных'),
            'hash' => $this->string()->comment('Хэш транзакции'),
        ], $tableOptions);
        $this->addForeignKey(
            'fk_transaction_category',
            '{{%transaction}}',
            'categoryId',
            '{{%category}}',
            'id',
            'SET NULL',
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%transaction}}');
        $this->dropTable('{{%rule}}');
        $this->dropTable('{{%category}}');
        $this->dropTable('{{%source}}');
    }

}
