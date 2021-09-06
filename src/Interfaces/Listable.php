<?php
declare(strict_types=1);

namespace Coinbase\Interfaces;

interface Listable
{
    public function list(array $options = []);
}