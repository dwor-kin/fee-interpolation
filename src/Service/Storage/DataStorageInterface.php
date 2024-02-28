<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\Storage;

use PragmaGoTech\Interview\Model\InterpolationPreConditionModelInterface;

interface DataStorageInterface
{
    public function findFee(float $amount): ?float;

    public function getInterpolationPreConditionModel(float $amount): InterpolationPreConditionModelInterface;
}
