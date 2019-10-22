<?php

namespace App\Services\Contracts;


interface TransactionServiceInterface
{
    public function run(\Closure $closure);
}
