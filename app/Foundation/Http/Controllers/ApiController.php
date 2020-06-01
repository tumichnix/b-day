<?php

namespace App\Foundation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

abstract class ApiController extends Controller
{
    public function authorize($ability, $arguments = [])
    {
        if (!Auth::guard($this->getGuard())->user()->can($ability, $arguments)) {
            throw new UnauthorizedRequestException(app('request'));
        }
    }

    protected function getGuard(): string
    {
        return 'user';
    }

    protected function getPerPage(): int
    {
        return 25;
    }
}
