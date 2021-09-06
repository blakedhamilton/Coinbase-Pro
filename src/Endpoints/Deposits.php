<?php
declare(strict_types=1);

namespace Coinbase\Endpoints;

use Coinbase\Interfaces\Createable;
use Coinbase\Interfaces\Getable;
use Coinbase\Interfaces\Listable;
use Coinbase\Traits\Helpers;

final class Deposits implements Listable, Getable, Createable
{
    use Helpers;    

    /**
     * https://docs.pro.coinbase.com#list-deposits
     */
    public function list(array $options = null)
    {
        return $this->helpers->sendRequest('GET', $this->helpers->withQuery('transfers', $options));
    }

    /**
     * https://docs.pro.coinbase.com#single-deposit
     */
    public function get(string $id)
    {
        return $this->helpers->sendRequest('GET', "transfers/$id");
    }

    /**
     * https://docs.pro.coinbase.com#payment-method
     * https://docs.pro.coinbase.com#coinbase
     */
    public function create(array $options = null)
    {
        if (is_null($options)) {
            trigger_error('Options can not be null', E_USER_ERROR);
        }

        if (!isset($options['payment_method_id']) && !isset($options['coinbase_account_id'])) {
            trigger_error('Either payment_method_id or coinbase_account_id are required', E_USER_ERROR);
        }

        $method = isset($options['payment_method_id']) ? 'payment-method' : 'coinbase-account';
        $path = "deposits/$method";

        return $this->helpers->sendRequest('POST', $path, $options);
    }

    /**
     * https://docs.pro.coinbase.com#generate-a-crypto-deposit-address
     */
    public function createCryptoDepositAddress(string $id)
    {
        return $this->helpers->sendRequest('POST', "coinbase-accounts/$id/addresses");
    }
}