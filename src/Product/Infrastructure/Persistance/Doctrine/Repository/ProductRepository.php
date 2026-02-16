<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Persistance\Doctrine\Repository;

use App\Product\Domain\Entity\Product;
use App\Product\Domain\Repository\ProductRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

final class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    )
    {
    }

    public function getCollection(bool $onlyAvalaible, ?int $maxPrice): array
    {
        $queryBuilder = $this->entityManager->createQueryBuilder()->select('p')
            ->from(Product::class, 'p');

        // if ($onlyAvalaible) {
        //     $queryBuilder->where('p.available = :available')
        //                  ->setParameter('available', true);
        // }

        if ($maxPrice !== null) {
            $queryBuilder->andWhere('p.price <= :maxPrice')
                         ->setParameter('maxPrice', $maxPrice);
        }

        return $queryBuilder->getQuery()->getResult();
    }

    public function save(Product $product): void
    {
        $this->entityManager->persist($product);
    }
}