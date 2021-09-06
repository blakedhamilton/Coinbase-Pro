<?php
declare(strict_types=1);

namespace Coinbase\Endpoints;

use Coinbase\Interfaces\SimpleGetable;
use Coinbase\Traits\Helpers;

final class Fees implements SimpleGetable
{
    use Helpers;

    /**
     * https://docs.pro.coinbase.com#get-current-fees
     */
    public function get()
    {
        return $this->helpers->sendRequest('GET', 'fees');
    }
}