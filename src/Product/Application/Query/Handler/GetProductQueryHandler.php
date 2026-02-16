<?php

namespace App\Product\Application\Query\Handler;

use App\Product\Application\Query\GetProductQuery;
use App\Product\Domain\Repository\ProductRepositoryInterface;

class GetProductQueryHandler
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository
    )
    {
    }

    public function __invoke(GetProductQuery $query): array
    {
        $result = [];
        $collection = $this->productRepository->getCollection($query->onlyAvailable, $query->maxPrice);
        foreach ($collection as $product) {
            $result[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'available' => $product->isAvailable()
            ];
        }

        return $result;
    }
}