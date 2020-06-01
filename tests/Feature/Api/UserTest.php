<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testViewRoute()
    {
        factory(User::class, $amount = 10)->create();

        $response = $this->get(route('api.user.get.index'));

        $response->assertStatus(Response::HTTP_OK);
        $this->assertArrayHasKey('id', $user = Arr::random($response->json('data')));
        $this->assertEquals('user', $user['type']);
        $this->assertArrayHasKey('attributes', $user);
        $this->assertArrayHasKey('email', Arr::get($user, 'attributes'));
        $this->assertEquals($amount, $response->json('meta')['total']);
    }
}
