<?php
declare(strict_types=1);

namespace Coinbase\Endpoints;

use Coinbase\Interfaces\Createable;
use Coinbase\Interfaces\Deleteable;
use Coinbase\Interfaces\Getable;
use Coinbase\Interfaces\Listable;
use Coinbase\Traits\Helpers;

final class Orders implements Listable, Getable, Createable, Deleteable
{
    use Helpers;

    /**
     * https://docs.pro.coinbase.com#list-orders
     */
    public function list(array $options = null)
    {
        return $this->helpers->sendRequest('GET', $this->helpers->withQuery('orders', $options));
    }

    /**
     * https://docs.pro.coinbase.com#get-an-order
     */
    public function get(string $id)
    {
        return $this->helpers->sendRequest('GET', "orders/$id");
    }

    /**
     * https://docs.pro.coinbase.com#place-a-new-order
     */
    public function create(array $options = null)
    {
        return $this->helpers->sendRequest('POST', 'orders', $options);
    }

    /**
     * https://docs.pro.coinbase.com#cancel-an-order
     */
    public function delete(string $id, array $options = null)
    {
        return $this->helpers->sendRequest('DELETE', $this->helpers->withQuery("orders/$id", $options));
    }

    /**
     * https://docs.pro.coinbase.com#cancel-all
     */
    public function deleteAll(array $options = null)
    {
        return $this->helpers->sendRequest('DELETE', $this->helpers->withQuery('orders', $options));
    }
}