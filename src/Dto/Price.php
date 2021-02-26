<?php

declare(strict_types=1);

namespace App\Dto;

final class Price
{
    public float $total;

    public float $tax;

    public string $currency;

    public function __construct(float $total, float $tax, string $currency)
    {
        $this->total    = $total;
        $this->tax      = $tax;
        $this->currency = $currency;
    }
}
