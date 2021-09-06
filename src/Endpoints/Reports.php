<?php
declare(strict_types=1);

namespace Coinbase\Endpoints;

use Coinbase\Interfaces\Createable;
use Coinbase\Interfaces\Getable;
use Coinbase\Interfaces\Listable;
use Coinbase\Traits\Helpers;

final class Reports implements Listable, Getable, Createable
{
    use Helpers;

    /**
     * https://docs.pro.coinbase.com#get-report-status
     */
    public function list(array $options = null)
    {
        return $this->helpers->sendRequest('GET', $this->helpers->withQuery('reports', $options));
    }

    /**
     * https://docs.pro.coinbase.com#get-report-status-270
     */
    public function get(string $id)
    {
        return $this->helpers->sendRequest('GET', "reports/$id");
    }

    /**
     * https://docs.pro.coinbase.com#create-a-new-report
     */
    public function create(array $options = null)
    {
        return $this->helpers->sendRequest('POST', 'reports', $options);
    }
}