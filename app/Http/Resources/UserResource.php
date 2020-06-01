<?php

namespace App\Http\Resources;

use App\Foundation\Http\Resources\Resource;

class UserResource extends Resource
{
    public function toArray($request): array
    {
        return [
            'type' => $this->getType($this->resource),
            'id' => $this->getKey(),
            'attributes'    => [
                'email' => $this->email,
                'display_name' => $this->display_name,
                'email_verified_at' => $this->email_verified_at,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'links' => [
                'self' => route('api.user.get.show', $this->getKey()),
            ],
        ];
    }
}
