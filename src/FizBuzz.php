<?php

declare(strict_types=1);

namespace Isfar;

use InvalidArgumentException;

class FizBuzz
{
    public function generate(int $start = 1, int $stop = 100): string
    {
        $string = '';

        if ($stop < $start || $start < 0 || $stop < 0) {
            throw new InvalidArgumentException();
        }

        for ($i = $start; $i <= $stop; $i++) {
            if ($i % 3 == 0 && $i % 5 == 0) {
                $string .= 'FizzBuzz';
                continue;
            }

            if ($i % 3 == 0) {
                $string .= 'Fizz';
                continue;
            }

            if ($i % 5 == 0) {
                $string .= 'Buzz';
                continue;
            }

            $string .= $i;
        }

        return $string;
    }
}
