<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_success(): void
    {
        // $this->withoutMiddleware();

        $param = Post::factory()->make();

        // [
        //     'title' => 'test',
        //     'body' => 'body'
        // ];

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post(
                route('posts.store'),
                $param->toArray()
            );

        $response->assertStatus(302);
    }

    public function test_unauthenticated()
    {
        $response = $this->post(route('posts.store'));

        $response->assertStatus(302);
    }
}
