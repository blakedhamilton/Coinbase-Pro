<?php
declare(strict_types=1);

namespace Coinbase\Endpoints;

use Coinbase\Interfaces\Getable;
use Coinbase\Interfaces\Listable;
use Coinbase\Traits\Helpers;

final class Accounts implements Listable, Getable
{
    use Helpers;

    /**
     * https://docs.pro.coinbase.com#list-accounts
     */
    public function list(array $options = null)
    {
        return $this->helpers->sendRequest('GET', 'accounts');
    }

    /**
     * https://docs.pro.coinbase.com#get-an-account
     */
    public function get(string $id)
    {
        return $this->helpers->sendRequest('GET', "accounts/$id");
    }

    /**
     * https://docs.pro.coinbase.com#get-account-history
     */
    public function getHistory(string $id, array $options = null)
    {
        return $this->helpers->sendRequest('GET', $this->helpers->withQuery("accounts/$id/ledger", $options));
    }

    /**
     * https://docs.pro.coinbase.com#get-holds
     */
    public function getHolds(string $id, array $options = null)
    {
        return $this->helpers->sendRequest('GET', $this->helpers->withQuery("accounts/$id/holds", $options));
    }
}