<?php
declare(strict_types=1);

namespace Coinbase\Endpoints;

use Coinbase\Interfaces\Listable;
use Coinbase\Traits\Helpers;

final class Fills implements Listable
{
    use Helpers;

    /**
     * https://docs.pro.coinbase.com#list-fills
     */
    public function list(array $options = null)
    {
        return $this->helpers->sendRequest('GET', $this->helpers->withQuery('fills', $options));
    }
}