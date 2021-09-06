<?php
declare(strict_types=1);

namespace Coinbase\Traits;

trait Helpers
{
    /**
     * @var \Coinbase\Helpers
     */
    protected $helpers;

    /**
     * @param $helpers The helper functions for sending and signing HTTP requests
     */
    public function __construct(\Coinbase\Helpers $helpers)
    {
        $this->helpers = $helpers;
    }
}