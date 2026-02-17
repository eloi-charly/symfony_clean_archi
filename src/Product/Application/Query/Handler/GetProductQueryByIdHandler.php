<?php

namespace App\Product\Application\Query\Handler;

use App\Product\Application\Query\GetProductQuery;
use App\Product\Domain\Repository\ProductRepositoryInterface;

class GetProductQueryByIdHandler
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository
    )
    {
    }

    public function __invoke(string $productId): ?array
    {
        $product = $this->productRepository->get($productId);
        if ($product === null) {
            return null;
        }

        return [
            'id' => $product->getId(),
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'available' => $product->isAvailable()
        ];
    }
}