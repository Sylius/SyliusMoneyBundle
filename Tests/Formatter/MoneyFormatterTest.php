<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Sylius Sp. z o.o.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Tests\Sylius\Bundle\MoneyBundle\Formatter;

use PHPUnit\Framework\TestCase;
use Sylius\Bundle\MoneyBundle\Formatter\MoneyFormatter;
use Sylius\Bundle\MoneyBundle\Formatter\MoneyFormatterInterface;

final class MoneyFormatterTest extends TestCase
{
    private MoneyFormatter $moneyFormatter;
    protected function setUp(): void
    {
        $this->moneyFormatter = new MoneyFormatter();
    }
    public function testImplementsMoneyFormatterInterface(): void
    {
        $this->assertInstanceOf(MoneyFormatterInterface::class, $this->moneyFormatter);
    }

    public function testFormatsPositiveMoneyUsingGivenCurrencyAndLocale(): void
    {
        $this->assertSame('$0.15', $this->moneyFormatter->format(15, 'USD', 'en'));
        $this->assertSame('$25.00', $this->moneyFormatter->format(2500, 'USD', 'en'));
        $this->assertSame('€3.12', $this->moneyFormatter->format(312, 'EUR', 'en'));
    }

    public function testFormatsPositiveMoneyUsingDefaultLocaleIfNotGiven(): void
    {
        $this->assertSame('$5.00', $this->moneyFormatter->format(500, 'USD'));
    }

    public function testFormatsNegativeMoneyUsingGivenCurrencyAndLocale(): void
    {
        $this->assertSame('-$0.15', $this->moneyFormatter->format(-15, 'USD', 'en'));
        $this->assertSame('-$25.00', $this->moneyFormatter->format(-2500, 'USD', 'en'));
        $this->assertSame('-€3.12', $this->moneyFormatter->format(-312, 'EUR', 'en'));
    }

    public function testFormatsNegativeMoneyUsingDefaultLocaleIfNotGiven(): void
    {
        $this->assertSame('-$5.00', $this->moneyFormatter->format(-500, 'USD'));
    }

    public function testFormatsZeroMoneyUsingGivenCurrencyAndLocale(): void
    {
        $this->assertSame('$0.00', $this->moneyFormatter->format(0, 'USD', 'en'));
        $this->assertSame('€0.00', $this->moneyFormatter->format(0, 'EUR', 'en'));
    }

    public function testFormatsZeroMoneyUsingDefaultLocaleIfNotGiven(): void
    {
        $this->assertSame('$0.00', $this->moneyFormatter->format(0, 'USD'));
    }
}
