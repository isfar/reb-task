<?php

declare(strict_types=1);

namespace Isfar\Cache;

interface AdapterInterface
{
    public function set(string $key, mixed $content, int $ttl): self;
    public function get(string $key): mixed;
}
