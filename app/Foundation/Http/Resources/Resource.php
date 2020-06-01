<?php

namespace App\Foundation\Http\Resources;

use App\Foundation\Http\JsonApiResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class Resource extends JsonResource
{
    use JsonApiResponse;

    public function getType($resource): string
    {
        return strtolower(Str::snake(class_basename($resource), '-'));
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
