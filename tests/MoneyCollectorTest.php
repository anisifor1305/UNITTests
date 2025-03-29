<?php

namespace AppUnitTests;

use App\MoneyCollector;
use Exception;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use PHPUnit\Runner\DeprecationCollector\Collector;

class MoneyCollectorTest extends TestCase
{
    public function testEarnMoney(): void 
    {
        $collector = new MoneyCollector('Илья');
        $collector->earnMoney(11000);

        $result = $collector->withdrawMoney();

        static::assertSame('Илья заработал 10000 руб.', $result, 'Илья должен был вывести 10000 руб.');
    }

    #[DataProvider('someDataProvider')]
    public function testEarnMoneyWithDataProvider(string $name, array $collected, int $expectedCollectedAmount): void
    {
        $collector = new MoneyCollector($name);
        foreach ($collected as $item) {
            $collector->earnMoney($item);
        }

        $result = $collector->withdrawMoney();

        static::assertSame("$name заработал $expectedCollectedAmount руб", $result);
    }

    public static function someDataProvider(): array 
    {
        return [
            'Маша' => ['Маша', [20000, 4400], 24400],
            'Игорь' => ['Игорь', [15000, 0], 15000],
            'Никита' => ['Никита', [15000, 3300, 50000, 13000], 81300]
        ];
    }

    public function testEarnTooMuchMoney() : void 
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('/^Рома/');
        
        $collector = new MoneyCollector('Рома');
        $collector->earnMoney(1000001);

        $result = $collector->withdrawMoney();
    }
}