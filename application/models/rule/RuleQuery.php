<?php


namespace app\models\rule;


use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for Rule
 *
 * @package app\models\rule
 * @see Rule
 */
class RuleQuery extends ActiveQuery
{
    public string $class;

    public function prepare($builder)
    {
        if ($this->class !== null) {
            $this->andWhere(['class' => $this->class]);
        }
        return parent::prepare($builder);
    }

}