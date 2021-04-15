<?php

namespace app\models\rule;

use app\models\category\Category;
use app\models\source\exception\BadRuleInitDataException;
use app\models\base\Rule as BaseRule;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "rule".
 */
abstract class Rule extends BaseRule implements RuleInterface
{

    public function behaviors(): array
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules(): array
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
            ]
        );
    }


    public function init(): void
    {
        $this->class = static::class;
        parent::init();
    }


    /**
     * @throws BadRuleInitDataException
     */
    public static function instantiate($row)
    {
        $class = $row['class'];
        try {
            $data = json_decode($row['data'], true, 512, JSON_THROW_ON_ERROR);
            return new $class($data);
        } catch (\JsonException $e) {
            throw new BadRuleInitDataException('Failed to instantiate ' . $class . ' because of json parse error');
        }
    }


    public function retrieveCategory() : Category
    {
        return $this->category;
    }

    public function beforeSave($insert): bool
    {
        try {
            $this->data = json_encode($this->toArray(), JSON_THROW_ON_ERROR);
        } catch (\Exception $exception) {
            return false;
        }
        return true;
    }
}
