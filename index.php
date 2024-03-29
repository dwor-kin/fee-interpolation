<?php

declare(strict_types=1);

require (__DIR__. '/vendor/autoload.php');

use PragmaGoTech\Interview\Enums\Term;
use PragmaGoTech\Interview\FeeCalculator;
use PragmaGoTech\Interview\Model\LoanProposal;

$calculator = new FeeCalculator();

try {
    $app = new LoanProposal(Term::T12, 19250);
    $resultModel = $calculator->calculate($app);
    echo $resultModel->getResult();
} catch (\Exception $e) {
    echo $e->getMessage();
}
