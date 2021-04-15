<?php


namespace app\models\source;


use app\models\transaction\TransactionCollection;

interface ITransactionSource
{
    public function retrieveTransactions(): TransactionCollection;
    public function loadFile(string $filename) : FileLoadingResult;
}