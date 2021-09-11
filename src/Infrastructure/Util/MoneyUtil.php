<?php

declare(strict_types=1);

namespace App\Infrastructure\Util;

use Money\Currencies\ISOCurrencies;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;
use Money\Parser\IntlMoneyParser;
use NumberFormatter;

class MoneyUtil
{
    private const LOCALE = 'de_DE';

    public static function parseString(string $moneyString): Money
    {
        $currencies = new ISOCurrencies();

        $formatter   = new NumberFormatter(self::LOCALE, NumberFormatter::CURRENCY);
        $moneyParser = new IntlMoneyParser($formatter, $currencies);

        return $moneyParser->parse($moneyString);
    }

    public static function formatToFloat(Money $money): float
    {
        $currencies     = new ISOCurrencies();
        $moneyFormatter = new DecimalMoneyFormatter($currencies);

        return (float) $moneyFormatter->format($money);
    }

    public static function formatToString(Money $money): string
    {
        $currencies = new ISOCurrencies();

        $numberFormatter = new NumberFormatter(self::LOCALE, NumberFormatter::CURRENCY);
        $moneyFormatter  = new IntlMoneyFormatter($numberFormatter, $currencies);

        return $moneyFormatter->format($money);
    }
}
