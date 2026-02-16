<?php

namespace App\Product\Application\Command;

class CreateProductCommand
{
    public function __construct(   
        public string $id, 
        public string $name, 
        public float $price,
        public bool $available
    )
    {
    }

}
