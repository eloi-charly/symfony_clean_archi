<?php 

namespace App\Product\Application\Command\Handler;

use App\Product\Application\Command\CommandValidatorInterface;
use App\Product\Application\Command\CreateProductCommand;
use App\Product\Domain\Entity\Product;
use App\Product\Domain\Repository\ProductRepositoryInterface;
use App\SharedKernel\Domain\Persistance\TransactionRunnerInterface;

class CreateProductCommandHandler
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly TransactionRunnerInterface $transactionRunner,
        private readonly CommandValidatorInterface $commandValidator
    )
    {}

    public function __invoke(CreateProductCommand $command): Product
    {
        $this->commandValidator->validate($command);
        /** @var Product $product */
        $product = $this->transactionRunner->run(function () use ($command) {

            $product = Product::create(
                $command->id,
                $command->name,
                $command->price,
                $command->available
            );

            $this->productRepository->save($product);

            return $product;
        });

        return $product;
    }
}