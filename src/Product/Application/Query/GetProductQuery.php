<?php

namespace App\Product\Application\Query;

class GetProductQuery
{
    public function __construct(
        public bool $onlyAvailable = false, 
        public ?int $maxPrice = null
    )
    {
    }
}