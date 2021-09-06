<?php
declare(strict_types=1);

namespace Coinbase;

use GuzzleHttp\Client;

final class Helpers
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

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
     * @param Client $client
     * @param string $key
     * @param string $secret
     * @param string $passphrase
     */
    public function __construct(Client $client, string $key, string $secret, string $passphrase)
    {
        $this->client = $client;
        $this->key = $key;
        $this->secret = $secret;
        $this->passphrase = $passphrase;
    }

    /**
     * @param string $method The request method
     * @param string $path The request path
     * @param array $body The request body
     * @param int $timestamp The request timestamp
     * @return string The request signature
     */
    private function sign(string $method, string $path, array $body = null, int $timestamp = null): string
    {
        $body = is_null($body) ? '' : json_encode($body);
        $timestamp = is_null($timestamp) ? time() : $timestamp;
        $path = "/$path";

        $what = $timestamp . $method . $path . $body;

        $secret = base64_decode($this->secret, true);
        $hash = hash_hmac('sha256', $what, $secret, true);

        return base64_encode($hash);
    }

    /**
     * Build a path with an optional query string
     * 
     * @param string $path The path
     * @param array $options The query args
     */
    public function withQuery(string $path, array $options = null): string
    {
        if (is_array($options) && count($options) > 0) {
            $path = sprintf('%s?%s', $path, http_build_query($options));
        }

        return $path;
    }

    /**
     * @param string $method The request method
     * @param string $path The request path
     * @param array|string $body The request body
     * @param int $timestamp The request timestamp
     * @return array|string|object The response body
     */
    public function sendRequest(string $method, string $path, array $body = null, int $timestamp = null): array|string|object
    {
        $timestamp = is_null($timestamp) ? time() : $timestamp;
        
        $options = [
            'headers' => [
                'CB-ACCESS-KEY' => $this->key,
                'CB-ACCESS-SIGN' => $this->sign($method, $path, $body, $timestamp),
                'CB-ACCESS-TIMESTAMP' => $timestamp,
                'CB-ACCESS-PASSPHRASE' => $this->passphrase
            ]
        ];

        if (is_array($body)) {
            $options['json'] = $body;
        }

        $response = $this->client->request($method, $path, $options);
        $status = $response->getStatusCode();
        $body = json_decode((string) $response->getBody());

        if (400 <= $status && $status <= 500) {
            $message = $body->message;
            $exception = 'Unknown'; 
            
            switch ($status) {
                case 400: $exception = 'BadRequest'; break;
                case 401: $exception = 'Unauthorized'; break;
                case 403: $exception = 'Forbidden'; break;
                case 404: $exception = 'NotFound'; break;
                case 500: $exception = 'InternalServerError'; break;
            }

            $class = __NAMESPACE__ . '\\Exceptions\\' . $exception . 'Exception';
            throw new $class($status, $message);
        }

        return $body;
    }
}