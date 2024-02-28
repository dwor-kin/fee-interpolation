<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview;

use PragmaGoTech\Interview\Enums\Multiplier;
use PragmaGoTech\Interview\Exception\AmountException;
use PragmaGoTech\Interview\Exception\TermException;
use PragmaGoTech\Interview\Model\InterpolationSchemaModelInterface;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Model\CalculationResultModel;
use PragmaGoTech\Interview\Service\Calculator\FeeInterpolationCalculator;
use PragmaGoTech\Interview\Service\Calculator\ValueMultiplier;
use PragmaGoTech\Interview\Service\Storage\JsonDataLoader;
use PragmaGoTech\Interview\Validators\LoanValidator;

final class FeeCalculator implements FeeCalculatorInterface
{
    /**
     * @throws AmountException
     * @throws TermException
     */
    public function calculate(LoanProposal $application): CalculationResultModel
    {
        (new LoanValidator($application))->validate();

        $jsonDataLoader = new JsonDataLoader($application);
        $dataStorage = $jsonDataLoader->getDataStructure();
        $foundedFee = $dataStorage->findFee($application->amount());

        if ($foundedFee === NULL) {
            $foundedFee = $this->calculateInterpolation(
                $application,
                $dataStorage->getInterpolationSchemaModel($application->amount()),
            );
        }

        $total = $this->multiplyValue($application->amount() + $foundedFee, Multiplier::M5);

        return new CalculationResultModel($application->amount(), $application->term(), $foundedFee, $total);
    }

    private function calculateInterpolation(
        LoanProposal                      $application,
        InterpolationSchemaModelInterface $interpolationSchemaModel,
    ): float
    {
        return (new FeeInterpolationCalculator($application->amount(), $interpolationSchemaModel))->calculate();
    }

    private function multiplyValue(float $amount, Multiplier $multiplier): float
    {
        return (new ValueMultiplier($amount, $multiplier))->calculate();
    }
}
