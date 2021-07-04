<?php

declare(strict_types=1);

namespace Isfar\Tests;

use Isfar\Set;
use PHPUnit\Framework\TestCase;

class SetTest extends TestCase
{
    public function testHas(): void
    {
        $array = [1, 4, 8, 10];
        $set = new Set($array);
        
        foreach ($array as $element) {
            $this->assertTrue($set->has($element));
        }

        $this->assertFalse($set->has(3));
    }
}
