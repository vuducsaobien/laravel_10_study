<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\UserService;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class UserServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private UserService $userService;
    private User $user;
    private string $username = 'UserServiceTest setUp';
    private string $email = 'UserServiceTest_setUp@example.com';

    protected function setUp(): void
    {
        parent::setUp();

        $this->userService = app(UserService::class);
        
        // Create a test user
        $this->user = User::factory()->create([
            'name' => $this->username, // Sau khi tạo User qua Factory, name sẽ đổi là
            'email' => $this->email,
        ]);

        // User Factory
        // $table->update([
        //     'name' => "table User - id : {$table->id}" // Chú ý: Sau khi tạo User qua Factory, name sẽ đổi lại
        // ]);
        // echo '<pre style="color:red";> 1 === '; print_r($this->user);echo '</pre>'; // name = table User - id : 1

        // Nên sẽ update lại name (Đã không sử dụng logic thay đổi name ở UserFactory nên không cần thiết)
        // $this->user->update([
        //     'name' => $this->username,  // Giữ tên ban đầu
        //     'email' => $this->email,   // Cập nhật email nếu cần
        // ]);

        // echo '<pre style="color:red";> 2 === '; print_r($this->user);echo '</pre>'; // name = UserServiceTest setUp
    }

    public function test_get_list_users()
    {
        // Create additional test users
        User::factory()->count(3)->create();
        $result = $this->userService->getListUsers();

        /*
            echo '<pre style="color:red";>$result === '; print_r($result);echo '</pre>';
            <pre style="color:red";>$result === Array
            (
            [0] => Array
                (
                    [id] => 1
                    [name] => table User - id : 1
                    [email] => UserServiceTest_setUp@example.com
                )

            [1] => Array
                (
                    [id] => 2
                    [name] => table User - id : 2
                    [email] => champlin.angelica@hoppe.biz
                )
        //*/

        $this->assertIsArray($result); // $result phải là mảng - array
        $this->assertCount(4, $result); // 3 new users - Factory+ 1 từ setUp $this->username, $this->email

        // Kiểm tra $this->user
        $this->assertEquals($this->username, $result[0]['name']);
        $this->assertEquals($this->email, $result[0]['email']);

        foreach ($result as $user) {
            // name
            // $this->assertMatchesRegularExpression('/table User - id : \d+/', $user['name']);
            // $this->assertTrue(isLikeFormat('/table User - id : \d+/', $user['name']));
            // $this->assertTrue();

            // email
            $this->assertNotEmpty($user['email']);
            $this->assertStringContainsString('@', $user['email']);
            $this->assertTrue(isEmailFormat($user['email']), "Email {$user['email']} is not valid.");
        }
    }

    public function test_get_user_by_id()
    {
        /*
            $this->user = ['email' => 'test_unit_test_service@example.com'] protected function setUp(): void
        */

        $result = $this->userService->getUserById($this->user->id);

        $this->assertIsArray($result);
        $this->assertEquals($this->user->id, $result['id']);
        $this->assertEquals($this->username, $result['name']);
        $this->assertEquals($this->email, $result['email']);
    }

    public function test_create_user()
    {
        $username = 'New User - test_create_user';
        $email = 'new_user_test_create_user@example.com';
        $userData = [
            'name' => $username,
            'email' => $email
        ];

        $result = $this->userService->createUser($userData);

        $this->assertIsObject($result);

        // Kiểm tra xem dữ liệu đã được lưu vào database chưa
        $this->assertDatabaseHas('users', [
            'name' => $username,
            'email' => $email
        ]);
        $this->assertEquals($username, $result['name']);
    }

    public function test_update_user()
    {
        // echo '<pre style="color:red";>$this->user - test_update_user === '; print_r($this->user);echo '</pre>';
        $user = 'Updated Name';
        $email = 'updated@example.com';
        $updateData = [
            'name' => $user,
            'email' => $email
        ];

        $result = $this->userService->updateUser($this->user->id, $updateData);

        $this->assertIsObject($result);
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'name' => $user,
            'email' => $email
        ]);
        $this->assertEquals($user, $result['name']);
    }

    public function test_delete_user()
    {
        $result = $this->userService->deleteUser($this->user->id);

        $this->assertIsObject($result);
        $this->assertDatabaseMissing('users', [
            'id' => $this->user->id
        ]);
    }
} 