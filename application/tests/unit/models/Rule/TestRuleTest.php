<?php

namespace app\tests\unit\models\Rule;


use app\models\rule\Rule;
use app\models\rule\TestRule;
use PHPUnit\Framework\TestCase;

class TestRuleTest extends TestCase
{
    public function fixtures()
    {
        return [
            \unit\models\Rule\fixtures\RuleFixture::class,
        ];
    }

    public function testRuleCreation()
    {
        $rule = Rule::findOne(1);
        self::assertInstanceOf(TestRule::class, $rule);
    }
}
