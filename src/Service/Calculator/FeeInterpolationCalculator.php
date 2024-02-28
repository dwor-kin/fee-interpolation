<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\Calculator;

use PragmaGoTech\Interview\Model\InterpolationPreConditionModelInterface;

readonly class FeeInterpolationCalculator implements CalculatorInterface
{
    public function __construct(
        private float                                   $amount,
        private InterpolationPreConditionModelInterface $interpolationPreConditionModel,
    )
    {
    }

    public function calculate(): float
    {
        $y0 = $this->interpolationPreConditionModel->getLowerFee();
        $y1 = $this->interpolationPreConditionModel->getUpperFee();
        $x0 = $this->interpolationPreConditionModel->getLowerAmount();
        $x1 = $this->interpolationPreConditionModel->getUpperAmount();

        return $y0 + ((($this->amount - $x0) * ($y1 - $y0)) / ($x1 - $x0));
    }
}
