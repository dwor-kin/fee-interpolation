<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\Calculator;

use PragmaGoTech\Interview\Enums\Multiplier;

readonly class ValueMultiplier implements CalculatorInterface
{
    public function __construct(
        private float      $amount,
        private Multiplier $multiplier,
    )
    {
    }

    public function calculate(): float
    {
        if (intval($this->amount) % $this->multiplier->value == 0) {
            return intval($this->amount);
        }

        return (ceil($this->amount / $this->multiplier->value) * $this->multiplier->value);
    }
}
