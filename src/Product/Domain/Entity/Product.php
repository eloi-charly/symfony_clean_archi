<?php 

namespace App\Product\Domain\Entity;

use App\Product\Domain\Exception\EmptyProductNameException;

class Product
{
    private string $id;
    private string $name;
    private float $price;
    private bool $available;

    public static function create(string $id, string $name, float $price, bool $available): self
    {
        if($name === '') {
            throw new EmptyProductNameException('Product name cannot be empty');
        }

        $product = new self();
        $product->id = $id;
        $product->name = $name;
        $product->price = $price;
        $product->available = $available;

        return $product;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }
}
