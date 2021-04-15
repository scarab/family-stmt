<?php


namespace app\models\rule;


use app\models\category\Category;
use app\models\transaction\Transaction;

interface RuleInterface
{
    public function isMatches(Transaction $transaction) : bool;
    public function retrieveCategory() : Category;
}