<?php
declare(strict_types=1);

namespace Coinbase\Endpoints\MarketData;

use Coinbase\Interfaces\Getable;
use Coinbase\Traits\Helpers;

final class Currencies implements Getable
{
    use Helpers;

    /**
     * https://docs.pro.coinbase.com#get-currencies
     * https://docs.pro.coinbase.com#get-a-currency
     */
    public function get(string $id = null)
    {
        $path = 'currencies';
        $args = func_get_args();

        if (count($args) > 0 && is_string($args[0])) {
            $id = $args[0];
            $path = "$path/$id";
        }

        return $this->helpers->sendRequest('GET', $path);
    }
}