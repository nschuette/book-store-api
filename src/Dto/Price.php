<?php

declare(strict_types=1);

namespace App\Dto;

final class Price
{
    public function __construct(
        private float $total,
        private float $tax,
        private string $currency
    ) {}

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
