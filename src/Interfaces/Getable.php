<?php
declare(strict_types=1);

namespace Coinbase\Interfaces;

interface Getable
{
    public function get(string $id);
}