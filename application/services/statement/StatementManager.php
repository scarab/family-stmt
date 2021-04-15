<?php

namespace app\services\statement;

use app\models\source\exception\NoParserException;
use app\models\source\exception\ParserErrorException;
use app\models\source\FileLoadingResult;
use app\models\source\SourceRepository;
use app\models\transaction\TransactionCollection;

class StatementManager
{

    private SourceRepository $sourceRepository;


    public function __construct(
        SourceRepository $sourceRepository
    )
    {
        $this->sourceRepository = $sourceRepository;
    }

    public function processFile(string $filename, int $sourceId): FileLoadingResult
    {
        $source = $this->sourceRepository->getById($sourceId);
        if (!$source) {
            throw new NoParserException('Не найден обработчик под номером ' . $sourceId);
        }

        $result = $source->loadFile($filename);
        if (!$result->loadSuccess) {
            throw new ParserErrorException('Ошибка при загрузке данных из файла: ' . $result->getErrors());
        }
        $transactions = $source->retrieveTransactions();
        $transactions->save();

        return $result;
    }

}