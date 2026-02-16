<?php

namespace App\SharedKernel\Domain\Persistance;

interface TransactionRunnerInterface
{
    public function run(callable $operation);
}