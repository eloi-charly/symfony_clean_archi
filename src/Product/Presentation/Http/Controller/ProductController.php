<?php

declare(strict_types=1);

namespace App\Product\Presentation\Http\Controller;

use App\Product\Application\Command\CreateProductCommand;
use App\Product\Application\Command\Handler\CreateProductCommandHandler;
use App\Product\Application\Query\GetProductQuery;
use App\Product\Application\Query\Handler\GetProductQueryHandler;
use App\SharedKernel\Http\ResponseEnvelope;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Uid\Uuid;

#[Route('/api/products')]
final class ProductController
{
    #[Route('/', name: 'products.list', methods: ['GET'])]
    public function index(GetProductQueryHandler $handler,Request $request): JsonResponse
    {
        $querry = new GetProductQuery($request->query->get('onlyAvalaible', false), $request->query->get('maxPrice', null));
        $data = $handler($querry);
    
        $envelope = ResponseEnvelope::success($data);

        return new JsonResponse($envelope->data, $envelope->statusCode);
    }

    #[Route('/', name: 'products.store', methods: ['POST'])]
    public function store(CreateProductCommandHandler $handler,Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $command = new CreateProductCommand(
            Uuid::v7()->toString(),
            $data['name'],
            $data['price'],
            $data['available']
        );
        $product = $handler($command);

        $envelope = ResponseEnvelope::success(['id' => $product->getId()], JsonResponse::HTTP_CREATED);

        return new JsonResponse($envelope->data, $envelope->statusCode);
    }
}