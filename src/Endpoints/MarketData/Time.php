<?php
declare(strict_types=1);

namespace Coinbase\Endpoints\MarketData;

use Coinbase\Interfaces\SimpleGetable;
use Coinbase\Traits\Helpers;

final class Time implements SimpleGetable
{
    use Helpers;

    /**
     * https://docs.pro.coinbase.com#time
     */
    public function get()
    {
        return $this->helpers->sendRequest('GET', 'time');
    }
}