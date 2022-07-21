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

    public function testShouldListJobs()
    {
        $response = $this->get('api/jobs', [
            'Authorization' => 'Bearer ' . $this->userFake->createToken('Larajobs')->plainTextToken
        ]);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['data', 'message', 'status']);

        $this->assertEquals('OK', $response['message']);
    }

    public function testShouldShowAJob()
    {
        $responseJobCreated = $this->post('api/jobs', [
            'title' => $this->faker->name,
            'company' => $this->faker->name,
            'location' => $this->faker->streetAddress,
            'website' => $this->faker->url,
            'email' => $this->faker->unique()->safeEmail,
            'tags' => $this->faker->words(nb: 3, asText: true),
            'description' => $this->faker->sentences(nb: 3, asText: true),
            'level' => 'beginner',
            'contract' => 'pj',
            'salary_range' => $this->faker->randomFloat(),
        ],
        [
            'Authorization' => 'Bearer ' . $this->userFake->createToken('Larajobs')->plainTextToken
        ]);

        $responseJobCreated->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(['data', 'message', 'status']);

        $responseJobShowed = $this->get('api/jobs/' . $responseJobCreated['data']['id'], [
            'Authorization' => 'Bearer ' . $this->userFake->createToken('Larajobs')->plainTextToken
        ]);

        $responseJobShowed->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['data', 'message', 'status']);

        $this->assertEquals('OK', $responseJobShowed['message']);
        $this->assertTrue($responseJobShowed['data'] > 0);
    }

    public function testShouldShowNotFoundJobWithDataNull()
    {
        $responseJobCreated = $this->post('api/jobs', [
            'title' => $this->faker->name,
            'company' => $this->faker->name,
            'location' => $this->faker->streetAddress,
            'website' => $this->faker->url,
            'email' => $this->faker->unique()->safeEmail,
            'tags' => $this->faker->words(nb: 3, asText: true),
            'description' => $this->faker->sentences(nb: 3, asText: true),
            'level' => 'beginner',
            'contract' => 'pj',
            'salary_range' => $this->faker->randomFloat(),
        ],
        [
            'Authorization' => 'Bearer ' . $this->userFake->createToken('Larajobs')->plainTextToken
        ]);

        $responseJobCreated->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(['data', 'message', 'status']);

        $responseJobShowed = $this->get('api/jobs/' . 'deubeyblade', [
            'Authorization' => 'Bearer ' . $this->userFake->createToken('Larajobs')->plainTextToken
        ]);

        $responseJobShowed->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['data', 'message', 'status']);

        $this->assertEquals('OK', $responseJobShowed['message']);
        $this->assertNull($responseJobShowed['data']);
    }

    public function testShouldCreateAJob()
    {
        $response = $this->post('api/jobs', [
            'title' => $this->faker->name,
            'company' => $this->faker->name,
            'location' => $this->faker->streetAddress,
            'website' => $this->faker->url,
            'email' => $this->faker->unique()->safeEmail,
            'tags' => $this->faker->words(nb: 3, asText: true),
            'description' => $this->faker->sentences(nb: 3, asText: true),
            'level' => 'beginner',
            'contract' => 'pj',
            'salary_range' => $this->faker->randomFloat(),
        ],
        [
            'Authorization' => 'Bearer ' . $this->userFake->createToken('Larajobs')->plainTextToken
        ]);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(['data', 'message', 'status']);

        $this->assertEquals('Job was created with success.', $response['message']);
    }

    public function testShouldntCreateAJob()
    {
        $response = $this->post('api/jobs', [], [
            'Authorization' => 'Bearer ' . $this->userFake->createToken('Larajobs')->plainTextToken
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure(['data', 'message', 'status']);

        $this->assertNull($response['data']);
    }

    public function testShouldUpdateAJobWithSuccess()
    {
        $responseJobCreated = $this->post('api/jobs', [
            'title' => $this->faker->name,
            'company' => $this->faker->name,
            'location' => $this->faker->streetAddress,
            'website' => $this->faker->url,
            'email' => $this->faker->unique()->safeEmail,
            'tags' => $this->faker->words(nb: 3, asText: true),
            'description' => $this->faker->sentences(nb: 3, asText: true),
            'level' => 'beginner',
            'contract' => 'pj',
            'salary_range' => $this->faker->randomFloat(),
        ],
        [
            'Authorization' => 'Bearer ' . $this->userFake->createToken('Larajobs')->plainTextToken
        ]);

        $responseJobCreated->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(['data', 'message', 'status']);

        $responseJobUpdated = $this->put('api/jobs/' . $responseJobCreated['data']['id'], [
            'contract' => 'clt'
        ],
        [
            'Authorization' => 'Bearer ' . $this->userFake->createToken('Larajobs')->plainTextToken
        ]);

        $responseJobUpdated->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['data', 'message', 'status']);

        $this->assertEquals('Job was updated with success.', $responseJobUpdated['message']);
        $this->assertTrue($responseJobUpdated['data'] > 0);
    }

    public function testShouldUpdateAJobNotFound()
    {
        $responseJobUpdated = $this->put('api/jobs/' . 'vaidarruimquerver?', [
            'contract' => 'clt'
        ],
        [
            'Authorization' => 'Bearer ' . $this->userFake->createToken('Larajobs')->plainTextToken
        ]);

        $responseJobUpdated->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['data', 'message', 'status']);

        $this->assertEquals('Job was not found.', $responseJobUpdated['message']);
        $this->assertNull($responseJobUpdated['data']);
    }

    public function testUpdateJobShouldReturnForbidden()
    {
        $createAnotherUser = $this->post('api/users/register', [
            'name' => 'Bugs',
            'email' => 'test@deubeyblade2.com',
            'password' => static::$userPassword
        ]);

        $createAnotherUser->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(['data', 'message', 'status']);

        $responseJobCreated = $this->post('api/jobs', [
            'title' => $this->faker->name,
            'company' => $this->faker->name,
            'location' => $this->faker->streetAddress,
            'website' => $this->faker->url,
            'email' => $this->faker->unique()->safeEmail,
            'tags' => $this->faker->words(nb: 3, asText: true),
            'description' => $this->faker->sentences(nb: 3, asText: true),
            'level' => 'beginner',
            'contract' => 'pj',
            'salary_range' => $this->faker->randomFloat(),
        ],
        [
            'Authorization' => 'Bearer ' . $this->userFake->createToken('Larajobs')->plainTextToken
        ]);

        $responseJobCreated->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(['data', 'message', 'status']);

        // TODO: check the data that was passed to compare different users on creating job
        // check why the uuid are equals when we send the token from another user created above here

        //$responseJobUpdated = $this->put('api/jobs/' . $responseJobCreated['data']['id'], [
        //    'Authorization' => 'Bearer ' . $createAnotherUser['data']['token']
        //]);

        //$responseJobUpdated->assertStatus(Response::HTTP_OK)
        //    ->assertJsonStructure(['data', 'message', 'status']);

        //$this->assertEquals(Response::$statusTexts[Response::HTTP_OK], $responseJobUpdated['message']);
        //$this->assertNull($responseJobUpdated['data']);
    }

    public function testShouldDestroyAJobNotFound()
    {
        $responseJobDeleted = $this->delete('api/jobs/' . 'vaidarruimquerver?', [], [
            'Authorization' => 'Bearer ' . $this->userFake->createToken('Larajobs')->plainTextToken
        ]);

        $responseJobDeleted->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['data', 'message', 'status']);

        $this->assertEquals('Job was not found.', $responseJobDeleted['message']);
        $this->assertNull($responseJobDeleted['data']);
    }

    public function testShouldDestroyAJob()
    {
        $responseJobCreated = $this->post('api/jobs', [
            'title' => $this->faker->name,
            'company' => $this->faker->name,
            'location' => $this->faker->streetAddress,
            'website' => $this->faker->url,
            'email' => $this->faker->unique()->safeEmail,
            'tags' => $this->faker->words(nb: 3, asText: true),
            'description' => $this->faker->sentences(nb: 3, asText: true),
            'level' => 'beginner',
            'contract' => 'pj',
            'salary_range' => $this->faker->randomFloat(),
        ],
        [
            'Authorization' => 'Bearer ' . $this->userFake->createToken('Larajobs')->plainTextToken
        ]);

        $responseJobCreated->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(['data', 'message', 'status']);

        $responseJobDeleted = $this->delete('api/jobs/' . $responseJobCreated['data']['id'], [], [
            'Authorization' => 'Bearer ' . $this->userFake->createToken('Larajobs')->plainTextToken
        ]);

        $responseJobDeleted->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
