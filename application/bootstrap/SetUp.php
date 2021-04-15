<?php

namespace app\bootstrap;

use app\models\rule\RuleRepository;
use app\models\source\SourceRepository;
use app\services\statement\StatementManager;
use app\services\transaction\TransactionManager;
use yii\base\BootstrapInterface;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = \Yii::$container;

        $container->set(SourceRepository::class);
        $container->set(RuleRepository::class);
        $container->set(StatementManager::class);
        $container->set(TransactionManager::class);

    }
}