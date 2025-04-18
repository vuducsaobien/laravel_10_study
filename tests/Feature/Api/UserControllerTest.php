<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class UserControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected string $apiKey;
    protected User $user;
    private $name = 'Test User';
    private $email = 'test_user@example.com';

    protected function setUp(): void
    {
        parent::setUp();

        $this->apiKey = getenv('X_API_KEY');
        // Create a test user
        $this->user = User::factory()->create([
            'name' => $this->name,
            'email' => $this->email
        ]);
    }

    public function test_get_list_users() // test UserController - getListUsers
    {
        // Create additional test users
        User::factory()->count(3)->create();

        $response = $this->withHeaders([
            'X-API-KEY' => $this->apiKey
        ])->getJson('/api/users');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    '*' => [
                    'id',
                    'name',
                    'email'
                ]
            ]
        ]);

        $this->assertEquals(4, count($response->json('data'))); // 3 new users + 1 test user
    }

    // public function test_get_user_by_id()
    // {
    //     $response = $this->withHeaders([
    //         'X-API-KEY' => $this->apiKey
    //     ])->getJson("/api/users/{$this->user->id}");

    //     $response->assertStatus(200)
    //             ->assertJsonStructure([
    //                 'success',
    //                 'message',
    //                 'data' => [
    //                     'id',
    //                     'name',
    //                     'email',
    //                     'created_at',
    //                     'updated_at'
    //                 ]
    //             ])
    //             ->assertJsonPath('data.name', 'Test User')
    //             ->assertJsonPath('data.email', 'test@example.com');
    // }

    // public function test_create_user()
    // {
    //     $userData = [
    //         'name' => 'New User',
    //         'email' => 'new@example.com',
    //         'password' => 'password123'
    //     ];

    //     $response = $this->withHeaders([
    //         'X-API-KEY' => $this->apiKey
    //     ])->postJson('/api/users', $userData);

    //     $response->assertStatus(200)
    //             ->assertJsonStructure([
    //                 'success',
    //                 'message',
    //                 'data' => [
    //                     'id',
    //                     'name',
    //                     'email',
    //                     'created_at',
    //                     'updated_at'
    //                 ]
    //             ])
    //             ->assertJsonPath('data.name', 'New User')
    //             ->assertJsonPath('data.email', 'new@example.com');

    //     $this->assertDatabaseHas('users', [
    //         'name' => 'New User',
    //         'email' => 'new@example.com'
    //     ]);
    // }

    // public function test_update_user()
    // {
    //     $updateData = [
    //         'name' => 'Updated Name',
    //         'email' => 'updated@example.com'
    //     ];

    //     $response = $this->withHeaders([
    //         'X-API-KEY' => $this->apiKey
    //     ])->putJson("/api/users/{$this->user->id}", $updateData);

    //     $response->assertStatus(200)
    //             ->assertJsonStructure([
    //                 'success',
    //                 'message',
    //                 'data' => [
    //                     'id',
    //                     'name',
    //                     'email',
    //                     'created_at',
    //                     'updated_at'
    //                 ]
    //             ])
    //             ->assertJsonPath('data.name', 'Updated Name')
    //             ->assertJsonPath('data.email', 'updated@example.com');

    //     $this->assertDatabaseHas('users', [
    //         'id' => $this->user->id,
    //         'name' => 'Updated Name',
    //         'email' => 'updated@example.com'
    //     ]);
    // }

    // public function test_delete_user()
    // {
    //     $response = $this->withHeaders([
    //         'X-API-KEY' => $this->apiKey
    //     ])->deleteJson("/api/users/{$this->user->id}");

    //     $response->assertStatus(200)
    //             ->assertJsonStructure([
    //                 'success',
    //                 'message',
    //                 'data'
    //             ])
    //             ->assertJsonPath('success', true);

    //     $this->assertDatabaseMissing('users', [
    //         'id' => $this->user->id
    //     ]);
    // }

    // public function test_unauthorized_access()
    // {
    //     $response = $this->getJson('/api/users');

    //     $response->assertStatus(401)
    //             ->assertJson([
    //                 'success' => false,
    //                 'message' => 'Unauthorized'
    //             ]);
    // }

    // public function test_invalid_api_key()
    // {
    //     $response = $this->withHeaders([
    //         'X-API-KEY' => 'invalid_key'
    //     ])->getJson('/api/users');

    //     $response->assertStatus(401)
    //             ->assertJson([
    //                 'success' => false,
    //                 'message' => 'Unauthorized'
    //             ]);
    // }
} 