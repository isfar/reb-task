<?php

declare(strict_types=1);

namespace Isfar\Cache\Adapter\Memcached\Connection;

class Config
{
    public function __construct(
        private string $host,
        private int $port = 11211,
    ) {
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getPort(): int
    {
        return $this->port;
    }
}
