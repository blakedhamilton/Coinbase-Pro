<?php
declare(strict_types=1);

namespace Coinbase\Websocket;

final class Client
{
    /**
     * @var string
     */
    private $uri;

    /**
     * @var callable
     */
    private $onMessage;

    /**
     * @param string $uri
     */
    public function __construct(string $uri)
    {
        $this->uri = $uri;
    }

    /**
     * 
     */
    private function onError(string $error)
    {
        echo "Error: $error";
        echo PHP_EOL;
    }

    /**
     * 
     */
    private function _onMessage($connection)
    {
        return function ($message) use ($connection) {
            $onMessage = $this->onMessage;
            
            if (is_callable($onMessage)) {
                $onMessage($message);
            }

            // $decoded = json_decode($message->__toString());
            // $type = $decoded->type;

            // switch ($type) {
            //     case 'error':
            //         $this->onError($decoded->message);
            //         break;
            //     default:
            //         echo "Message: $message";
            //         echo PHP_EOL;
            // }
        };
    }

    /**
     * 
     */
    private function onSuccess(array $productIds, array $channels)
    {
        return function ($connection) use ($productIds, $channels) {
            $onMessage = $this->_onMessage($connection);
            $connection->on('message', $onMessage);

            $message = [
                'type' => 'subscribe',
                'product_ids' => $productIds,
                'channels' => $channels
            ];

            $message = json_encode($message);
            $connection->send($message);
        };
    }

    /**
     * 
     */
    private function onRejected()
    {
        return function ($error) {
            trigger_error($error->getMessage(), E_USER_WARNING);
        };
    }

    /**
     * 
     */
    public function subscribe(array $productIds, array $channels)
    {
        $onSuccess = $this->onSuccess($productIds, $channels);
        $onRejected = $this->onRejected();
        \Ratchet\Client\connect($this->uri)->then($onSuccess, $onRejected);
        return $this;
    }

    /**
     * 
     */
    public function then(callable $onMessage)
    {
        $this->onMessage = $onMessage;
    }
}