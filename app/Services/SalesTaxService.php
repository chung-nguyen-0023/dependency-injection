<?php

declare(strict_types = 1);

namespace App\Services;

class SalesTaxService
{
    public function calculate(float $amount): float
    {
        return $amount * 10 / 100;
    }
}
