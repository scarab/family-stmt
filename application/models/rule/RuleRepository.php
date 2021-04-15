<?php


namespace app\models\rule;


class RuleRepository
{
    public function retrieveCollection() : RuleCollection
    {
        $rules = Rule::find()
            ->all();
        return new RuleCollection($rules);
    }
}