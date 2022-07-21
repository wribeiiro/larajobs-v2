<?php

namespace Tests\Unit\App\Http\Controllers;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;

class VacancyJobControllerTest extends TestCase
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
}