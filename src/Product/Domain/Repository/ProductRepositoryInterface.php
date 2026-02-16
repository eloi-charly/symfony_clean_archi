<?php

namespace App\Product\Domain\Repository;

use App\Product\Domain\Entity\Product;

interface ProductRepositoryInterface
{
      public function getCollection(bool $onlyAvalaible, ?int $maxPrice): array;

      public function save(Product $product): void;
}