<?php

namespace App\SharedKernel\Http;

readonly class ResponseEnvelope
{
    public function __construct(
        public readonly int $statusCode,
        public readonly array $data = []
    ) {
    }

    public static function success(array $data = [], int $statusCode = 200, array $meta = []): self
    {
        $body = ['data' => $data];

        if(!empty($meta)) {
            $body['meta'] = $meta;
        }

        return new self($statusCode, $body);
    }

    public static function error(string $statusCode, string $message, string $type = 'error', ?int $traceId = null, array $detail = []): self
    {
        $err = ['code' => $statusCode, 'message' => $message, 'type' => $type];

        if($traceId !== null) {
            $err['traceId'] = $traceId;
        }

        if(!empty($detail)) {
            $err['detail'] = $detail;
        }

        return new self($statusCode, ['error' => $err]);
    }
}