<?php

declare(strict_types=1);

namespace Isfar;

class PhoneNumberFormatter
{
    public function format(string $input): string
    {
        $numbers = '';

        for ($i = 0; $i < strlen($input); $i++) {
            $char = $input[$i];

            if (ord($char) >= 48 && ord($char) <= 57) {
                $numbers .= $char; 
            }
        }

        return implode('-', [
            substr($numbers, 0, 3),
            substr($numbers, 3, 3),
            substr($numbers, 6, 4),
        ]);
    }
}
