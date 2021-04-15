<?php

$rootPath = dirname(__DIR__, 2);
$mainDb = require __DIR__ . '/../../config/db.php';

return yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../../config/console.php',
    [
        'id' => 'app-test',
        'basePath' => $rootPath,
    ],
    [
        'components' => [
            'db' => require __DIR__ . '/../../config/test_db.php',
            'main-db' => $mainDb['components']['db'],
        ]
    ]
);
