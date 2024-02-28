<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\Storage;

use PragmaGoTech\Interview\Model\LoanProposal;

readonly class JsonDataLoader implements DataLoaderInterface
{
    private const FEE_DIRECTORY = __DIR__ . '../../../DataSource/FeeFormula';

    public function __construct(private LoanProposal $application)
    {
    }

    public function getDataStructure(): DataStorageInterface
    {
        return new DataStorage($this->loadData($this->application->term()->value));
    }

    private function loadData(int $term): ?array
    {
        $jsonFileName = self::FEE_DIRECTORY . $term . '.json';

        $fileContents = file_get_contents($jsonFileName);

        if ($fileContents !== false) {
            return json_decode($fileContents, true);
        } else {
            return null;
        }
    }
}
