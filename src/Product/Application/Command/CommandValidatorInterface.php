<?php

namespace App\Product\Application\Command;

interface CommandValidatorInterface
{
    public function validate(object $command, array $context = []): void;
}