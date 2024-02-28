<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Validators;

use PragmaGoTech\Interview\Exception\AmountException;
use PragmaGoTech\Interview\Exception\TermException;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Enums\Amount;
use PragmaGoTech\Interview\Enums\Term;

readonly class LoanValidator
{
    public function __construct(private LoanProposal $loanProposal)
    {
    }

    /**
     * @throws AmountException
     * @throws TermException
     */
    public function validate(): void
    {
        $this->validateLoan();
        $this->validateTerm();
    }

    /**
     * @throws AmountException
     */
    private function validateLoan(): void
    {
        if ($this->loanProposal->amount() < Amount::AMOUNT_MIN->value || $this->loanProposal->amount() > Amount::AMOUNT_MAX->value) {
            throw new AmountException(
                sprintf('Invalid amount value, must be between %s and %s',
                    Amount::AMOUNT_MIN->value, Amount::AMOUNT_MAX->value
                )
            );
        }
    }

    /**
     * @throws TermException
     */
    private function validateTerm(): void
    {
        if ($this->loanProposal->term()->value < Term::T12->value || $this->loanProposal->term()->value > Term::T24->value) {
            throw new TermException(
                sprintf('Invalid term value, must be between %s and %s',
                    Term::T12->value, Term::T24->value
                )
            );
        }
    }
}
