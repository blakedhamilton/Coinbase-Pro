<?php
declare(strict_types=1);

namespace Coinbase;

use GuzzleHttp\Client;
use Coinbase\Websocket\Client as Websocket;

class Coinbase
{
    /**
     * @var Coinbase
     */
    private static $instance;

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $secret;

    /**
     * @var string
     */
    private $passphrase;

    /**
     * @var bool
     */
    private $sandbox;

    /**
     * @var GuzzleHttp\Client
     */
    private $client;

    /**
     * @var Coinbase\Webscoket\Client
     */
    public $websocket;

    /**
     * @var Coinbase\Helpers
     */
    private $helpers;

    /**
     * @param string $key
     * @param string $secret
     * @param string $passphrase
     * @param bool $sandbox
     */
    private function __construct(string $key, string $secret, string $passphrase, bool $sandbox)
    {
        $this->key = $key;
        $this->secret = $secret;
        $this->passphrase = $passphrase;
        $this->sandbox = $sandbox;

        $this->websocket = new Websocket(
            $this->sandbox ? 'wss://ws-feed-public.sandbox.pro.coinbase.com' : 'wss://ws-feed.pro.coinbase.com'
        );
        
        $this->client = new Client([
            'base_uri' => $this->sandbox ? 'https://api-public.sandbox.pro.coinbase.com/' : 'https://api.pro.coinbase.com/',
            'http_errors' => false
        ]);

        $this->helpers = new Helpers($this->client, $this->key, $this->secret, $this->passphrase);
    }

    /**
     * @param string $name
     */
    public function __get(string $name)
    {
        $class =  __NAMESPACE__ . '\\Endpoints\\' . ucfirst($name);
        $exists = class_exists($class);

        if ($exists) {
            return new $class($this->helpers);
        }

        trigger_error("Property '$name' does not exist", E_USER_ERROR);
    }

    /**
     * @param string $key Your Coinbase Pro API key
     * @param string $secret Your Coinbase Pro API secret key
     * @param string $passphrase Your Coinbase Pro API passphrase
     * @param bool $sandbox Running in sandbox mode for testing / development?
     */
    public static function create(string $key = '', string $secret = '', string $passphrase = '', bool $sandbox = false): self
    {
        if (is_null(self::$instance) || !(self::$instance instanceof Coinbase)) {
            self::$instance = new self($key, $secret, $passphrase, $sandbox);
        }

        return self::$instance;
    }
}