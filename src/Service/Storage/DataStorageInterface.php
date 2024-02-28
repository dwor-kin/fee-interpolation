<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\Storage;

use PragmaGoTech\Interview\Model\InterpolationSchemaModelInterface;

interface DataStorageInterface
{
    public function findFee(float $amount): ?float;

    public function getInterpolationSchemaModel(float $amount): InterpolationSchemaModelInterface;
}
