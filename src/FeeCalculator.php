<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview;

use PragmaGoTech\Interview\Enums\Multiplier;
use PragmaGoTech\Interview\Exception\AmountException;
use PragmaGoTech\Interview\Exception\TermException;
use PragmaGoTech\Interview\Model\InterpolationPreConditionModelInterface;
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
                $dataStorage->getInterpolationPreConditionModel($application->amount()),
            );
        }

        $total = $this->multiplyValue($application->amount() + $foundedFee, Multiplier::M5);

        return new CalculationResultModel($application->amount(), $application->term(), $foundedFee, $total);
    }

    private function calculateInterpolation(
        LoanProposal                            $application,
        InterpolationPreConditionModelInterface $interpolationPreConditionModel,
    ): float
    {
        return (new FeeInterpolationCalculator($application->amount(), $interpolationPreConditionModel))->calculate();
    }

    private function multiplyValue(float $amount, Multiplier $multiplier): float
    {
        return (new ValueMultiplier($amount, $multiplier))->calculate();
    }
}
