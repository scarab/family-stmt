<?php


namespace app\models\rule;


use app\models\transaction\Transaction;

class TestRule extends Rule
{
    public function isMatches(Transaction $transaction) : bool
    {
        return true;
    }
}