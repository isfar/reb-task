<?php

declare(strict_types=1);

namespace Isfar\Tests;

use InvalidArgumentException;
use Isfar\FizBuzz;
use PHPUnit\Framework\TestCase;

class FizBuzzTest extends TestCase
{
    private FizBuzz $fizBuzz;

    public function setUp(): void
    {
        $this->fizBuzz = new FizBuzz();        
    }

    /**
     * @dataProvider dataProviderForGenerateThrowsExceptionTesting
     */
    public function testGenerateThrowsException(int $start, int $stop): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->fizBuzz->generate($start, $stop);
    }

    public function dataProviderForGenerateThrowsExceptionTesting(): array
    {
        return [
            'stop is smaller than start' => [6, 5],
            'start is smaller than 0' => [-1, 6],
            'stop is smaller than 0' => [1, 0],
        ];
    }

    /**
     * @dataProvider dataProviderForGenerateTesting
     */
    public function testGenerate(int $start, int $stop, string $expected): void
    {
        $output = $this->fizBuzz->generate($start, $stop);
        $this->assertSame($expected, $output);
    }

    public function dataProviderForGenerateTesting(): array
    {
        return [
            'not divisible by 3 or 5' => [
                1,
                2,
                '12'
            ],
            'divisible by 3' => [
                1,
                3,
                '12Fizz'
            ],
            'divisible by 5' => [
                4,
                5,
                '4Buzz'
            ],
            'divisible by 3 & 5' => [
                3,
                5,
                'Fizz4Buzz'
            ],
            'divisible by 3 & 5 and both' => [
                10,
                16,
                'Buzz11Fizz1314FizzBuzz16'
            ],
        ];
    }
}
