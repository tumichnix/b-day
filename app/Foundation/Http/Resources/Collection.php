<?php

namespace App\Foundation\Http\Resources;

use App\Foundation\Http\JsonApiResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Collection extends ResourceCollection
{
    use JsonApiResponse;

    public function toArray($request): array
    {
        return [
            'data' => $this->collection,
        ];
    }

    public function with($request): array
    {
        return [
            'meta' => [
                'environments' => $this->getEnvironments($request),
            ],
        ];
    }
}
