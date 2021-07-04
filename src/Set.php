<?php

declare(strict_types=1);

namespace Isfar;

class Set
{
    /**
     * @var array<int, bool>
     */
    private array $hashMap = [];

    /**
     * @param int[] $elements
     */
    public function __construct(array $elements)
    {
        foreach ($elements as $element) {
            $this->hashMap[$element] = true;
        }
    }

    public function has(int $element): bool
    {
        return isset($this->hashMap[$element]);
    }
}