<?php

declare(strict_types=1);

namespace Isfar\Cache\Adapter;

use Isfar\Cache\AdapterInterface;
use Memcached;

class MemcachedAdapter implements AdapterInterface
{
    public function __construct(private Memcached $memcached)
    {
    }

    public function set(string $key, mixed $content, int $ttl = 0): AdapterInterface
    {
        $this->memcached->set($key, $content, $ttl);

        return $this;
    }

    public function get(string $key): mixed
    {
        return $this->memcached->get($key);
    }
}
