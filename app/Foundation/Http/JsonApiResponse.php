<?php

namespace App\Foundation\Http;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Support\Arrayable;

trait JsonApiResponse
{
    protected function getEnvironments(Request $request): array
    {
        return [
            'version' => 'v1',
            'datetime' => Carbon::now('UTC'),
            'method' => $request->getMethod(),
            'uri' => $request->getUri(),
            'runtime' => microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'],
        ];
    }

    protected function json($data, $status = Response::HTTP_OK, array $error = [], array $meta = [], array $headers = [], $options = 0): JsonResponse
    {
        $request = app('request');

        $error = $this->getArray($error);
        if (count($error) == 0) {
            $error = false;
        }

        $meta = $this->getArray($meta);
        $meta['environment'] = $this->getEnvironments($request);

        return response()->json([
            'data' => $this->getArray($data),
            'error' => $error,
            'meta' => $meta,
        ], $status, $headers);
    }

    protected function getArray($value): array
    {
        if (is_array($value)) {
            return $value;
        } elseif ($value instanceof Arrayable) {
            return $value->toArray();
        }

        return [];
    }
}
