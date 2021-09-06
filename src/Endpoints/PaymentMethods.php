<?php
declare(strict_types=1);

namespace Coinbase\Endpoints;

use Coinbase\Interfaces\SimpleGetable;
use Coinbase\Traits\Helpers;

final class PaymentMethods implements SimpleGetable
{
    use Helpers;

    /**
     * All of the available options are documented at
     * https://docs.pro.coinbase.com#list-payment-methods
     */
    public function get()
    {
        return $this->helpers->sendRequest('GET', 'payment-methods');
    }
}