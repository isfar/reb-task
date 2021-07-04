<?php

declare(strict_types=1);

namespace Isfar\Cache\Adapter;

use Isfar\Cache\AdapterInterface;

class NullAdapter implements AdapterInterface
{
    public function set(string $key, mixed $content, int $ttl = 0): AdapterInterface
    {
        return $this;
    }

    public function get(string $key): mixed
    {
        return null;
    }
}
