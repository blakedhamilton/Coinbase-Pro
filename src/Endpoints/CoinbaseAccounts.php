<?php
declare(strict_types=1);

namespace Coinbase\Endpoints;

use Coinbase\Interfaces\SimpleGetable;
use Coinbase\Traits\Helpers;

final class CoinbaseAccounts implements SimpleGetable
{
    use Helpers;

    /**
     * https://docs.pro.coinbase.com#list-accounts64
     */
    public function get(): array
    {
        return $this->helpers->sendRequest('GET', 'coinbase-accounts');
    }
}