<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_view_create_user_page()
    {
        $admin = User::factory()->create(['user_type' => 'admin']);

        $response = $this->actingAs($admin)
            ->get(route('admin.users.create'));

        $response->assertStatus(200);
        $response->assertSee('Create User');
    }

    /** @test */
    public function it_requires_mandatory_fields()
    {
        $admin = User::factory()->create(['user_type' => 'admin']);

        $response = $this->actingAs($admin)
            ->post(route('admin.users.store'), []);

        $response->assertSessionHasErrors(['name', 'email', 'password', 'user_type']);
    }

    /** @test */
    public function it_creates_a_new_user_successfully()
    {
        $admin = User::factory()->create(['user_type' => 'admin']);

        $data = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'phone' => '1234567890',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'user_type' => 'staff', // assuming 'staff' is a valid type in User::getUserTypes()
            'is_active' => 1,
        ];

        $response = $this->actingAs($admin)
            ->post(route('admin.users.store'), $data);

        $response->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseHas('users', [
            'email' => 'johndoe@example.com',
            'name'  => 'John Doe',
            'phone' => '1234567890',
            'user_type' => 'staff',
            'is_active' => 1,
        ]);
    }

    /** @test */
    public function password_must_be_confirmed()
    {
        $admin = User::factory()->create(['user_type' => 'admin']);

        $data = [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => 'password123',
            'password_confirmation' => 'wrongpass',
            'user_type' => 'staff',
        ];

        $response = $this->actingAs($admin)
            ->post(route('admin.users.store'), $data);

        $response->assertSessionHasErrors('password');
    }
}
