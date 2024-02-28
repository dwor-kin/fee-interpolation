<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\Calculator;

use PragmaGoTech\Interview\Model\InterpolationSchemaModelInterface;

readonly class FeeInterpolationCalculator implements CalculatorInterface
{
    public function __construct(
        private float                             $amount,
        private InterpolationSchemaModelInterface $interpolationSchemaModel,
    )
    {
    }

    public function calculate(): float
    {
        $y0 = $this->interpolationSchemaModel->getLowerFee();
        $y1 = $this->interpolationSchemaModel->getUpperFee();
        $x0 = $this->interpolationSchemaModel->getLowerAmount();
        $x1 = $this->interpolationSchemaModel->getUpperAmount();

        return $y0 + ((($this->amount - $x0) * ($y1 - $y0)) / ($x1 - $x0));
    }
}
