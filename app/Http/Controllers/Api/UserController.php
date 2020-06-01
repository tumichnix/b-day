<?php

namespace App\Http\Controllers\Api;

use App\Foundation\Http\Controllers\ApiController;
use App\Http\Resources\Collections\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends ApiController
{
    public function getIndex(): UserCollection
    {
        return new UserCollection(User::paginate($this->getPerPage()));
    }

    public function getShow(User $user): UserResource
    {
        return new UserResource($user);
    }
}
