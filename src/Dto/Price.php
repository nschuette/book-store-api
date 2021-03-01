<?php

declare(strict_types=1);

namespace App\Dto;

final class Price
{
    private float $total;

    private float $tax;

    private string $currency;

    public function __construct(float $total, float $tax, string $currency)
    {
        $this->total    = $total;
        $this->tax      = $tax;
        $this->currency = $currency;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function getTax(): float
    {
        return $this->tax;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}
