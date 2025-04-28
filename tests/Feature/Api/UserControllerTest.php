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

    public function test_get_user_by_id()
    {
        $response = $this->withHeaders([
            'X-API-KEY' => $this->apiKey
        ])->getJson("/api/users/{$this->user->id}");

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'success',
                    'message',
                    'data' => [
                        'id',
                        'name',
                        'email'
                    ]
                ])
                ->assertJsonPath('data.name', $this->name)
                ->assertJsonPath('data.email', $this->email);
    }

    public function test_create_user()
    {
        $name = 'New User 1';
        $email = 'new_1@example.com';
        $userData = [
            'name' => $name,
            'email' => $email
        ];

        $response = $this->withHeaders([
            'X-API-KEY' => $this->apiKey
        ])->postJson('/api/users', $userData);

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'success',
                    'message',
                    'data' => [
                        'id',
                        'name',
                        'email'
                    ]
                ])
                ->assertJsonPath('data.name', $name)
                ->assertJsonPath('data.email', $email);

        $this->assertDatabaseHas('users', [
            'name' => $name,
            'email' => $email
        ]);
    }

    public function test_update_user()
    {
        $name = 'Updated Name';
        $email = 'updated@example.com';
        $updateData = [
            'name' => $name,
            'email' => $email
        ];

        $response = $this->withHeaders([
            'X-API-KEY' => $this->apiKey
        ])->putJson("/api/users/{$this->user->id}", $updateData);

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'success',
                    'message',
                    'data' => [
                        'id',
                        'name',
                        'email'
                    ]
                ])
                ->assertJsonPath('data.name', $name)
                ->assertJsonPath('data.email', $email);

        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'name' => $name,
            'email' => $email
        ]);
    }

    public function test_delete_user()
    {
        $response = $this->withHeaders([
            'X-API-KEY' => $this->apiKey
        ])->deleteJson("/api/users/{$this->user->id}");

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'success',
                    'message',
                    'data'
                ])
                ->assertJsonPath('success', true);

        $this->assertDatabaseMissing('users', [
            'id' => $this->user->id
        ]);
    }

    public function test_unauthorized_access() // Không có X-API-KEY
    {
        $response = $this->getJson('/api/users');

        $response->assertStatus(401)
                ->assertJson([
                    'success' => false,
                    'message' => 'Unauthorized'
                ]);
    }

    public function test_invalid_api_key() // X-API-KEY không giống trong env
    {
        $response = $this->withHeaders([
            'X-API-KEY' => 'invalid_key'
        ])->getJson('/api/users');

        $response->assertStatus(401)
                ->assertJson([
                    'success' => false,
                    'message' => 'Unauthorized'
                ]);
    }
} 