<?php
declare(strict_types=1);

namespace Coinbase\Endpoints;

use Coinbase\Traits\Helpers;

final class MarketData
{
    use Helpers;

    /**
     * @param string $name
     */
    public function __get(string $name)
    {
        $class =  __NAMESPACE__ . '\\MarketData\\' . ucfirst($name);
        $exists = class_exists($class);

        if ($exists) {
            return new $class($this->helpers);
        }

        trigger_error("Property '$name' does not exist", E_USER_ERROR);
    }
}