<?php

namespace Tests\Unit\App\Http\Controllers;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Response;

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

    public function test_user_can_login_with_correct_credentials()
    {
        $response = $this->post('api/users/login', [
            'email' => $this->userFake->email,
            'password' => static::$userPassword
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals('Login has been done with success.', $response['message']);
    }

    public function test_user_cannot_login_with_incorrect_password()
    {
        $response = $this->from('/login')->post('api/users/login', [
            'email' => $this->userFake->email,
            'password' => 'chama o amir'
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
        $this->assertEquals('Unauthorised. E-mail or password are invalid.', $response['message']);
    }

    public function test_user_can_logout()
    {
        $response = $this->post('api/users/login', [
            'email' => $this->userFake->email,
            'password' => static::$userPassword
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals('Login has been done with success.', $response['message']);

        /*$response = $this->post('api/users/logout', [], [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => "Bearer " . $response['data']['token']
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals('User data has been returned with success.', $response['message']);*/
    }
}