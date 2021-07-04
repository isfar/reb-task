<?php

declare(strict_types=1);

namespace Isfar\Cache\Adapter\Memcached;

use Isfar\Cache\Adapter\Memcached\Connection\Config;
use Memcached;

class Factory
{
    /**
     * @param Config[] $connectionConfigs
     * @return Memcached
     */
    public static function create(array $connectionConfigs): Memcached
    {
        $memcached = new Memcached();

        foreach ($connectionConfigs as $config) {
            $memcached->addServer($config->getHost(), $config->getPort());
        }

        return $memcached;
    }
}
