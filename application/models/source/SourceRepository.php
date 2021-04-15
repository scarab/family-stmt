<?php


namespace app\models\source;


class SourceRepository
{
    public function getById(int $id): Source
    {
        return Source::findOne($id);
    }


    public function getForMainMenu()
    {
        $result = [];

        foreach(Source::find()->all() as $record) {
            $entry['label'] = $record->name;
            $entry['url'] = \yii\helpers\Url::to(['source/index', 'id' => $record->id]);
            $result[] = $entry;
        }

        return $result;
    }
}