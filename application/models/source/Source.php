<?php

namespace app\models\source;

use \app\models\base\Source as BaseSource;
use app\models\source\exception\NoParserException;
use app\services\transaction\TransactionManager;

/**
 * This is the model class for table "source".
 */
abstract class Source extends BaseSource implements ITransactionSource
{
    protected TransactionManager $transactionManager;

    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->transactionManager = \Yii::$container->get(TransactionManager::class);
    }

    public function init()
    {
        $this->class = static::class;
        parent::init();
    }


    public static function instantiate($row)
    {
        $className = $row['class'];

        if (class_exists($className)) {
            return new $row['class'];
        } else {
            throw new NoParserException('Не найден экземпляр класса ' . $className);
        }

    }

}
