<?php

declare(strict_types=1);

namespace Isfar\Cache\Adapter;

use Isfar\Cache\AdapterInterface;

class ApcAdapter implements AdapterInterface
{
    public function set(string $key, mixed $content, int $ttl = 0): AdapterInterface
    {
        apcu_store($key, $content, $ttl);

        return $this;
    }

    public function get(string $key): mixed
    {
        $content = apcu_fetch($key, $success);

        return $success ? $content : null;
    }
}
