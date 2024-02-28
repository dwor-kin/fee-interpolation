<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\Storage;

use PragmaGoTech\Interview\Model\InterpolationSchemaModel;
use PragmaGoTech\Interview\Model\InterpolationSchemaModelInterface;

readonly class DataStorage implements DataStorageInterface
{
    public function __construct(private array $data)
    {
    }

    public function findFee(float $amount): ?float
    {
        $keys = array_keys($this->data);
        $index = array_search($amount, $keys);

        return ($index !== false)
            ? $this->data[$keys[$index]]
            : null;
    }

    public function getInterpolationSchemaModel(float $amount): InterpolationSchemaModelInterface
    {
        $filteredKeys = array_filter(array_keys($this->data), function ($key) use ($amount) {
            return $key <= $amount;
        });

        $lowerBreakPointValue = max($filteredKeys);
        $upperBreakPointValue = min(array_diff(array_keys($this->data), $filteredKeys));

        return new InterpolationSchemaModel(
            $lowerBreakPointValue,
            $upperBreakPointValue,
            $this->data[$lowerBreakPointValue],
            $this->data[$upperBreakPointValue],
        );
    }
}
