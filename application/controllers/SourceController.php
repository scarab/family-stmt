<?php


namespace app\controllers;


use app\services\statement\StatementManager;
use yii\web\Controller;

class SourceController extends Controller
{
    public function actionIndex($id, StatementManager $manager)
    {
        $result = $manager->processFile(\Yii::getAlias('@runtime/test/test.csv'), $id);
        print_r($result);
    }
}