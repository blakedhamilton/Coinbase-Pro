<?php
declare(strict_types=1);

namespace Coinbase\Endpoints;

use Coinbase\Interfaces\Createable;
use Coinbase\Interfaces\Getable;
use Coinbase\Interfaces\Listable;
use Coinbase\Traits\Helpers;

final class Profiles implements Listable, Getable, Createable
{
    use Helpers;

    /**
     * https://docs.pro.coinbase.com#list-profiles
     */
    public function list(array $options = null)
    {
        return $this->helpers->sendRequest('GET', $this->helpers->withQuery('profiles', $options));
    }

    /**
     * https://docs.pro.coinbase.com#get-a-profile
     */
    public function get(string $id)
    {
        return $this->helpers->sendRequest('GET', "profiles/$id");
    }

    /**
     * https://docs.pro.coinbase.com#create-profile-transfer
     */
    public function create(array $options = null)
    {
        return $this->helpers->sendRequest('POST', 'profiles/transfer', $options);
    }
}