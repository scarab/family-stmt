<?php

namespace app\models\transaction;

use \app\models\base\Transaction as BaseTransaction;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "transaction".
 *
 * @property \DateTime $transactionDate
 * @property \DateTime $loadDate
 */
class Transaction extends BaseTransaction
{
    /**
     * @return \DateTime
     * @throws \Exception
     */
    public function getLoadDate(): \DateTime
    {
        return new \DateTime($this->_loadDate);
    }

    /**
     * @param \DateTime $loadDate
     */
    public function setLoadDate(\DateTime $loadDate): void
    {
        $this->_loadDate = $loadDate->format('Y-m-d H:i:s');
    }

    /**
     * @return \DateTime
     * @throws \Exception
     */
    public function getTransactionDate(): \DateTime
    {
        return new \DateTime($this->_transactionDate);
    }


    /**
     * @param \DateTime $transactionDate
     */
    public function setTransactionDate(\DateTime $transactionDate): void
    {
        $this->_transactionDate = $transactionDate->format('Y-m-d H:i:s');
    }

    /**
     * @return \DateTime
     * @throws \Exception
     */
    public function getExportDate(): \DateTime
    {
        return new \DateTime($this->_exportDate);
    }


    /**
     * @param \DateTime $exportDate
     */
    public function setExportDate(\DateTime $exportDate): void
    {
        $this->_exportDate = $exportDate->format('Y-m-d H:i:s');
    }


    public function behaviors(): array
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules(): array
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
            ]
        );
    }
}
