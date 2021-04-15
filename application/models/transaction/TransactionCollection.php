<?php


namespace app\models\transaction;


use Ramsey\Collection\AbstractCollection;

class TransactionCollection extends AbstractCollection
{
    public function getType(): string
    {
        return Transaction::class;
    }

    public function save()
    {
        foreach ($this->data as $entry) {
            print_r($entry);
            $entry->save();
        }
    }
}