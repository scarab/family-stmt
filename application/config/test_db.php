<?php
$db = require __DIR__ . '/db.php';

// test database! Important not to run tests on production or development databases
$db = \yii\helpers\ArrayHelper::merge($db, [
    'dsn' => 'mysql:host=localhost;dbname=' . env('TESTDB_NAME'),
    'username' => env('TESTDB_USER'),
    'password' => env('TESTDB_PASS'),
]);

return $db;
