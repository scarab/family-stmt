<?php


namespace app\models\source;


use yii\base\BaseObject;

/**
 * Результат загрузки файла
 * Включает в себя список ошибок, количество загруженных и распарсенных записей
 *
 * Class FileLoadingResult
 * @package app\models\source
 *
 * @property-read bool $loadSuccess
 */
class FileLoadingResult extends BaseObject
{
    public int   $totalRecords;
    public int   $parsedRecords;
    public array $errors = [];


    public function addError(string $error): void
    {
        $this->errors[] = $error;
    }

    public function getErrors(): string
    {
        return implode("\n", $this->errors);
    }

    /**
     * @return bool
     */
    public function getLoadSuccess(): bool
    {
        return ($this->totalRecords === $this->parsedRecords) && empty($this->errors);
    }


}