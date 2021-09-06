<?php
declare(strict_types=1);

namespace Coinbase\Exceptions;

use Exception;

abstract class BaseException extends Exception
{
    /**
     * @var int
     */
    protected $status;

    /**
     * @var string
     */
    protected $message;

    /**
     * @param int $status
     * @param string $message
     */
    public function __construct(int $status, string $message)
    {
        $this->status = $status;
        $this->message = $message;
    }
}