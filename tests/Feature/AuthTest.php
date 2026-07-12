<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_login_with_valid_credentials(): void
    {
        User::factory()->create(['email' => 'admin@test.dev']);

        $this->postJson('/api/admin/auth/login', [
            'email' => 'admin@test.dev',
            'password' => 'password',
        ])
            ->assertOk()
            ->assertJsonPath('status', 'success')
            ->assertJsonStructure(['data' => ['token', 'user' => ['id', 'name', 'email']]]);
    }

    public function test_login_fails_with_invalid_credentials(): void
    {
        User::factory()->create(['email' => 'admin@test.dev']);

        $this->postJson('/api/admin/auth/login', [
            'email' => 'admin@test.dev',
            'password' => 'wrong-password',
        ])->assertStatus(401);
    }

    public function test_admin_routes_require_authentication(): void
    {
        $this->getJson('/api/admin/projects')->assertStatus(401);
    }
}
