<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

readonly final class InterpolationPreConditionModel implements InterpolationPreConditionModelInterface
{
    public function __construct(
        private readonly int $lowerAmount,
        private readonly int $upperAmount,
        private readonly int $lowerFee,
        private readonly int $upperFee,
    )
    {
    }

    public function getLowerAmount(): int
    {
        return $this->lowerAmount;
    }

    public function getUpperAmount(): int
    {
        return $this->upperAmount;
    }

    public function getLowerFee(): int
    {
        return $this->lowerFee;
    }

    public function getUpperFee(): int
    {
        return $this->upperFee;
    }
}
