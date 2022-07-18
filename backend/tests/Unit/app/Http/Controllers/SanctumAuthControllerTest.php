<?php

namespace Tests\Unit\App\Http\Controllers;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SantumAuthControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_user_can_login_with_correct_credentials()
    {
        $user = \App\Models\User::factory()->create([
            'password' => bcrypt($password = 'password'),
        ]);

        $response = $this->post('users/authenticate', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/listings/manage');
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_login_with_incorrect_password()
    {
        $user = \App\Models\User::factory()->create([
            'password' => bcrypt('beyblade'),
        ]);

        $response = $this->from('/login')->post('users/authenticate', [
            'email' => $user->email,
            'password' => 'de-ruim',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function test_user_can_logout()
    {
        $user = \App\Models\User::factory()->create([
            'password' => bcrypt($password = 'beyblade'),
        ]);

        $response = $this->post('users/authenticate', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/listings/manage');
        $this->assertAuthenticatedAs($user);

        $response = $this->post('/logout');
        $response->assertRedirect('/');
    }
}