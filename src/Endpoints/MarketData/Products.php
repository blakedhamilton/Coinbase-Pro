<?php
declare(strict_types=1);

namespace Coinbase\Endpoints\MarketData;

use Coinbase\Interfaces\Getable;
use Coinbase\Traits\Helpers;

final class Products implements Getable
{
    use Helpers;

    /**
     * https://docs.pro.coinbase.com#get-products
     * https://docs.pro.coinbase.com#get-single-product
     */
    public function get(string $id = null)
    {
        $path = 'products';
        $args = func_get_args();

        if (count($args) > 0 && is_string($args[0])) {
            $id = $args[0];
            $path = "$path/$id";
        }

        return $this->helpers->sendRequest('GET', $path);
    }

    /**
     * https://docs.pro.coinbase.com#get-product-order-book
     */
    public function getOrderBook(string $id, array $options = null)
    {
        return $this->helpers->sendRequest('GET', $this->helpers->withQuery("products/$id/book", $options));
    }

    /**
     * https://docs.pro.coinbase.com#get-product-ticker
     */
    public function getTicker(string $id)
    {
        return $this->helpers->sendRequest('GET', "products/$id/ticker");
    }

    /**
     * https://docs.pro.coinbase.com#get-trades
     */
    public function getTrades(string $id, array $options = null)
    {
        return $this->helpers->sendRequest('GET', $this->helpers->withQuery("products/$id/trades", $options));
    }
    
    /**
     * https://docs.pro.coinbase.com#get-historic-rates
     */
    public function getHistoricRates(string $id, array $options = null)
    {
        return $this->helpers->sendRequest('GET', $this->helpers->withQuery("products/$id/candles", $options));
    }

    /**
     * https://docs.pro.coinbase.com#get-24hr-stats
     */
    public function getDailyStats(string $id)
    {
        return $this->helpers->sendRequest('GET', "products/$id/stats");
    }
}