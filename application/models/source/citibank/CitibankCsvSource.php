<?php

namespace app\models\source\citibank;

use app\models\source\exception\ParserErrorException;
use app\models\source\FileLoadingResult;
use app\models\source\Source;
use app\models\transaction\Transaction;
use app\models\source\exception\NoInputFileException;
use app\models\transaction\TransactionCollection;

/**
 *
 * @property-read mixed $parsedLines
 * @property-read mixed $linesInFile
 */
class CitibankCsvSource extends Source
{
    private array $file;
    private array $rawData;
    private TransactionCollection $transactions;

    /**
     * CitibankCsvSource constructor.
     */
    public function __construct()
    {
        $this->transactions = new TransactionCollection();
        parent::__construct();
    }


    public function retrieveTransactions(): TransactionCollection
    {
        return $this->transactions;
    }

    /**
     * @throws NoInputFileException
     */
    public function loadFile(string $filename) : FileLoadingResult
    {
        setlocale(LC_CTYPE, 'ru_RU.UTF8');
        $result = new FileLoadingResult();

        // Проверяем существование файла
        if (!is_readable($filename)) {
            throw new NoInputFileException('Не найден файл с выпиской: ' . $filename);
        }

        // Загружаем файл
        $this->file = file($filename);

        // Проходимся по файлу и разбираем CSV
        foreach ($this->file as $line) {
            $record = str_getcsv($line);
            if (is_array($record)) {
                $this->rawData[] = $record;
                try {
                    $this->transactions[] = $this->prepareTransaction($record);
                } catch (ParserErrorException $exception) {
                    $result->addError(print_r($record, true));
                }

            }
        }

        $result->totalRecords = $this->getLinesInFile();
        $result->parsedRecords = $this->getParsedLines();

        return $result;

    }


    /**
     * Разбирает запись и формирует из неё транзакцию
     *
     * @param array $record
     * @return Transaction
     * @throws ParserErrorException
     */
    protected function prepareTransaction(array $record): Transaction
    {

        try {
            $date = preg_replace('|[^0-9/]|', '', $record[0]);
            $transaction = $this->transactionManager->create(
                \DateTime::createFromFormat('d/m/Y|', $date),
                $record[2],
                $record[1],
                'RUR'
            );
        } catch (\Exception $e) {
            \Yii::warning("Transaction parse error");
            \Yii::warning(print_r($record, true));
            throw new ParserErrorException("Ошибка обработки транзакции");
        }
        return $transaction;
    }


    public function getLinesInFile(): int
    {
        return count($this->file);
    }

    public function getParsedLines(): int
    {
        return count($this->rawData);
    }
}