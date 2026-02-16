<?php 

namespace App\SharedKernel\Infrastructure\Persistance\Doctrine;

use App\SharedKernel\Domain\Persistance\TransactionRunnerInterface;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineTransactionRunner implements TransactionRunnerInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    )
    {
    }

    public function run(callable $operation)
    {
       return $this->entityManager->getConnection()->transactional(function () use ($operation) {
            $result =  $operation();
            $this->entityManager->flush();

            return $result;
        });
    }
}