<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview;

use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Model\CalculationResultModel;

interface FeeCalculatorInterface
{
    /**
     * @return CalculationResultModel model that contains amount, fee, term and total calculation
     */
    public function calculate(LoanProposal $application): CalculationResultModel;
}
