<?php

namespace app\services\transaction;

use app\models\rule\RuleRepository;
use app\models\transaction\Transaction;
use app\models\transaction\TransactionCollection;

class TransactionManager
{
    private RuleRepository $ruleRepository;

    public function __construct(
        RuleRepository $ruleRepository
    )
    {
        $this->ruleRepository = $ruleRepository;
    }

    public function create(
        \DateTime $datetime,
        float $amount,
        string $place,
        string $currency
    ): Transaction
    {
        $transaction = new Transaction();
            $transaction->transactionDate = $datetime;
            $transaction->amount = $amount;
            $transaction->place = $place;
            $transaction->currency = $currency;
            $transaction->loadDate = new \DateTime();
        return $transaction;
    }

    public function massAssignCategory(TransactionCollection $transactions)
    {
        foreach ($transactions as &$transaction) {
            $this->assignCategory($transaction);
        }
    }

    
    public function assignCategory(Transaction $transaction): void
    {
        $rules = $this->ruleRepository->retrieveCollection();
        foreach($rules as $rule) {
            if ($rule->isMatch($transaction)) {
                $transaction->setCategory($rule->retrieveCategory());
            }
        }
    }

}