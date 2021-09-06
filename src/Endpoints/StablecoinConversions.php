<?php
declare(strict_types=1);

namespace Coinbase\Endpoints;

use Coinbase\Interfaces\Createable;
use Coinbase\Traits\Helpers;

final class StablecoinConversions implements Createable
{
    use Helpers;

    /**
     * https://docs.pro.coinbase.com#stablecoin-conversions
     */
    public function create(array $options = null)
    {
        return $this->helpers->sendRequest('POST', 'conversions', $options);
    }
}