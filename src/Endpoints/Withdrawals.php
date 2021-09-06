<?php
declare(strict_types=1);

namespace Coinbase\Endpoints;

use Coinbase\Interfaces\Createable;
use Coinbase\Interfaces\Getable;
use Coinbase\Interfaces\Listable;
use Coinbase\Traits\Helpers;

final class Withdrawals implements Listable, Getable, Createable
{
    use Helpers;

    /**
     * https://docs.pro.coinbase.com#list-withdrawals
     */
    public function list(array $options = null)
    {
        return $this->helpers->sendRequest('GET', $this->helpers->withQuery('transfers', $options));
    }

    /**
     * https://docs.pro.coinbase.com#single-withdrawal
     */
    public function get(string $id)
    {
        return $this->helpers->sendRequest('GET', "transfers/$id");
    }

    /**
     * https://docs.pro.coinbase.com#payment-method55
     * https://docs.pro.coinbase.com#coinbase56
     */
    public function create(array $options = null)
    {
        if (is_null($options)) {
            trigger_error('Options can not be null', E_USER_ERROR);
        }

        if (!isset($options['payment_method_id']) && !isset($options['coinbase_account_id']) && !isset($options['crypto_address'])) {
            trigger_error('Either payment_method_id, coinbase_account_id or crypto_address is required', E_USER_ERROR);
        }

        $method = null;

        if (isset($options['payment_method_id'])) {
            $method = 'payment-method';
        } else if (isset($options['coinbase_account_id'])) {
            $method = 'coinbase-account';
        } else {
            $method = 'crypto';
        }

        $path = "withdrawals/$method";

        return $this->helpers->sendRequest('POST', $path, $options);
    }

    /**
     * https://docs.pro.coinbase.com#fee-estimate
     */
    public function getFeeEstimate(array $options = null)
    {
        return $this->helpers->sendRequest('GET', $this->helpers->withQuery('withdrawals/fee-estimate', $options));
    }
}