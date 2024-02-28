<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

interface InterpolationSchemaModelInterface
{
    public function getLowerAmount(): int;

    public function getUpperAmount(): int;

    public function getLowerFee(): int;

    public function getUpperFee(): int;
}
