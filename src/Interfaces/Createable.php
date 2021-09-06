<?php
declare(strict_types=1);

namespace Coinbase\Interfaces;

interface Createable
{
    public function create(array $options = []);
}