<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Enums\Term;
use PragmaGoTech\Interview\Exception\AmountException;
use PragmaGoTech\Interview\Exception\TermException;
use PragmaGoTech\Interview\FeeCalculator;
use PragmaGoTech\Interview\Model\LoanProposal;

class FeeCalculatorTest extends TestCase
{
    private FeeCalculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new FeeCalculator();
    }

    public static function properLoanPropositions(): array
    {
        return [
            [3000.00, Term::T12, 3090.0],
            [4000.50, Term::T12, 4115.0],
            [15000.00, Term::T24, 15600.0],
            [15750.50, Term::T24, 16380.0],
            [7500.50, Term::T24, 7800.0],
            [11500.00, Term::T24, 11960.0],
        ];
    }

    public static function wrongAmountPropositions(): array
    {
        return [
            [999.9, Term::T12],
            [20000.1, Term::T12],
            [999.9, Term::T24],
            [20000.1, Term::T24],
        ];
    }

    public static function wrongTermPropositions(): array
    {
        return [
            [15000.00, Term::T6],
            [18000.1, Term::T36],
        ];
    }

    /**
     * @dataProvider properLoanPropositions
     */
    public function testCalculateFeesForSelectedAmountAndTerm(float $amount, Term $term, float $expectedTotal)
    {
        $loanProposal = new LoanProposal($term, $amount);
        $calculationResultModel = $this->calculator->calculate($loanProposal);
        $this->assertEquals($expectedTotal, $calculationResultModel->getTotal());
        $this->assertEquals($amount, $calculationResultModel->getAmount());
        $this->assertEquals($term->value, $calculationResultModel->getTerm()->value);
    }

    /**
     * @dataProvider wrongAmountPropositions
     */
    public function testCalculateFeesShouldThrowAnExceptionDueToWrongAmount(float $amount, Term $term)
    {
        $loanProposal = new LoanProposal($term, $amount);
        $this->expectException(AmountException::class);
        $this->calculator->calculate($loanProposal);
    }

    /**
     * @dataProvider wrongTermPropositions
     */
    public function testCalculateFeeShouldThrowAnExceptionDueToWrongTerm(float $amount, Term $term)
    {
        $loanProposal = new LoanProposal($term, $amount);
        $this->expectException(TermException::class);
        $this->calculator->calculate($loanProposal);
    }
}
