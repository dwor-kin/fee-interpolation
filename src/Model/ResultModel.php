<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

use PragmaGoTech\Interview\Enums\Term;

readonly final class ResultModel
{
    public function __construct(private float $amount, private Term $term, private float $fee, private float $total)
    {
    }

    public function getResult(): string
    {
        return sprintf(
            'Loan amount: %s PLN, Term: %s months, Fee: %s PLN, Total: %s PLN',
            $this->formatValue($this->amount),
            $this->term->value,
            $this->formatValue(ceil($this->fee)),
            $this->formatValue($this->total),
        );
    }

    private function formatValue(float $value): string
    {
        return number_format($value, 2, '.', ',');
    }
}



