<?php


namespace app\models\rule;


use Ramsey\Collection\AbstractCollection;

class RuleCollection extends AbstractCollection
{
    public function getType(): string
    {
        return Rule::class;
    }
}