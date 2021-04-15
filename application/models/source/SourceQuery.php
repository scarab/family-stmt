<?php


namespace app\models\source;


use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for Source
 *
 * @package app\models\source
 * @see Source
 */
class SourceQuery extends ActiveQuery
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