<?php

namespace Tests\Feature;

use App\Http\Controllers\AuthController;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testRegister(): void
    {
        $request = StoreUserRequest::create('/api/register', 'POST', [
            'first_name' => $this->faker->name,
            'last_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        /** @var TestResponse $response */
        $response = (new AuthController())->register($request);
        $testResponse = TestResponse::fromBaseResponse($response);
        $testResponse->assertStatus(201)->assertJsonStructure([
            'user' => [
                'id',
                'first_name',
                'last_name',
                'email',
                'created_at',
                'updated_at',
            ],
            'token',
        ]);
    }

    public function testRegisterAdmin(): void
    {
        $this->withoutExceptionHandling();

        Gate::shouldReceive('allowIf')->once()->andReturnUsing(function ($callback) {
            $user = User::factory()->create();
            $adminRole = Role::create(['name' => 'admin']);
            $user->roles()->attach($adminRole);
            return $callback($user);
        });

        $user = User::factory()->make();
        $token = 'test-token';

        $request = StoreUserRequest::create('/api/admin/register', 'POST', $user->toArray());
        $request->merge(['password' => Hash::make($request['password'])]);

        /** @var TestResponse $response */
        $response = (new AuthController())->registerAdmin($request);
        $testResponse = TestResponse::fromBaseResponse($response);
        $testResponse->assertStatus(201)->assertJsonStructure([
            'user' => [
                'id',
                'first_name',
                'last_name',
                'email',
                'created_at',
                'updated_at',
            ],
            'token',
        ]);
    }

    public function testLogin(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);
        $token = $user->createToken('Login')->plainTextToken;
        $request = UpdateUserRequest::create('/api/login', 'POST', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        Auth::shouldReceive('attempt')->once()->andReturn(true);
        Auth::shouldReceive('id')->once()->andReturn($user->id);

        /** @var TestResponse $response */
        $response = (new AuthController())->login($request);
        $testResponse = TestResponse::fromBaseResponse($response);
        $testResponse->assertStatus(200)->assertJsonStructure([
            'user' => [
                'id',
                'first_name',
                'last_name',
                'email',
                'created_at',
                'updated_at',
            ],
            'token',
        ]);

        $response->assertStatus(200);
    }

    public function testLogout(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/logout');

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Logged out',
            ]);
    }
}
