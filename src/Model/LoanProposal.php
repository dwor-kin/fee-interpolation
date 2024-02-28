<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

use PragmaGoTech\Interview\Enums\Term;

/**
 * A cut down version of a loan application containing
 * only the required properties for this test.
 */
readonly class LoanProposal
{
    public function __construct(private Term $term, private float $amount)
    {
    }

    /**
     * Term (loan duration) for this loan application
     * in number of months.
     */
    public function term(): Term
    {
        return $this->term;
    }

    /**
     * Amount requested for this loan application.
     */
    public function amount(): float
    {
        return $this->amount;
    }
}
