<?php

declare(strict_types=1);

namespace Isfar\Tests;

use Isfar\PhoneNumberFormatter;
use PHPUnit\Framework\TestCase;

class PhoneNumberFormatterTest extends TestCase
{
    /**
     * @dataProvider dataProviderForFormatTesting
     */
    public function testFormat(string $input): void
    {
        $phoneNumberFormatter = new PhoneNumberFormatter();
        $expected = '123-456-7890';
        $output = $phoneNumberFormatter->format($input);
        $this->assertSame($expected, $output);
    }

    /**
     * @return array<array<string>>
     */
    public function dataProviderForFormatTesting(): array
    {
        return [
            ['123-456-7890'],
            ['(123) 456-7890'],
            ['1234567890'],
            ['+123 456 7890'],
        ];
    }
}
