<?php

namespace Tests\Unit\App\Http\Controllers;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;

class SantumAuthControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private \App\Models\User $userFake;
    private static string $userPassword = 'password';

    public function setUp(): void
    {
        parent::setUp();

        $this->userFake = \App\Models\User::factory()->create([
            'password' => bcrypt(static::$userPassword),
        ]);
    }

    public function test_user_register_with_success()
    {
        $response = $this->post('api/users/register', [
            'email' => 'test@deubeyblade.com',
            'password' => static::$userPassword
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure(['data', 'message', 'status']);
    }

    public function test_user_register_with_errors_email_already_exists()
    {
        $response = $this->post('api/users/register', [
            'email' => $this->userFake->email,
            'password' => static::$userPassword
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure(['data', 'message', 'status']);
    }

    public function test_user_register_with_errors()
    {
        $response = $this->post('api/users/register', [
            'email' => 'test@error',
            'password' => static::$userPassword
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure(['data', 'message', 'status']);
    }

    public function test_user_can_login_with_correct_credentials()
    {
        $response = $this->post('api/users/login', [
            'email' => $this->userFake->email,
            'password' => static::$userPassword
        ]);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['data', 'message', 'status']);
        $this->assertEquals('Login has been done with success.', $response['message']);
    }

    public function test_user_cannot_login_with_incorrect_password()
    {
        $response = $this->post('api/users/login', [
            'email' => $this->userFake->email,
            'password' => 'chama o amir'
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertJsonStructure(['data', 'message', 'status']);
        $this->assertEquals('Unauthorized. E-mail or password are invalid.', $response['message']);
    }

    public function test_user_should_view_info()
    {
        Sanctum::actingAs($this->userFake);

        $response = $this->get('api/users/me');
        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['data', 'message', 'status']);

        $this->assertEquals('User data has been returned with success.', $response['message']);
    }

    public function test_user_can_logout()
    {
        Sanctum::actingAs($this->userFake);

        $response = $this->post('api/users/logout');
        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['data', 'message', 'status']);

        $this->assertEquals('User and token was disconnected', $response['message']);
    }
}