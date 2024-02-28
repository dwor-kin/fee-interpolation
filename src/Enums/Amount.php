<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Enums;

enum Amount: int
{
    case AMOUNT_MIN = 1000;
    case AMOUNT_MAX = 20000;
}
