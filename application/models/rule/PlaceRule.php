<?php


namespace app\models\rule;


use app\models\transaction\Transaction;

class PlaceRule extends Rule
{
    public $place;

    public function fields(): array
    {
        return [
            'place',
        ];
    }

    public function __construct($config = [])
    {
        $this->place = $config['place'];
        parent::__construct($config);
    }

    public function isMatches(Transaction $transaction): bool
    {
        return (bool)mb_stristr($transaction->place, $this->place);
    }
}