<?php
declare(strict_types=1);

namespace Coinbase\Interfaces;

interface Deleteable
{
    public function delete(string $id, array $options = null);
    public function deleteAll(array $options = null);
}