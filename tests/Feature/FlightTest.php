<?php

namespace Tests\Feature;

use App\Http\Controllers\FlightController;
use App\Http\Requests\StoreFlightRequest;
use App\Http\Requests\UpdateFlightRequest;
use App\Models\Flight;
use App\Models\Role;
use App\Models\User;
use App\Http\Resources\FlightResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class FlightTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testIndex()
    {
        $this->withoutExceptionHandling();
        $admin = User::factory()->create();
        $adminRole = Role::factory()->create(['name' => 'admin']);
        $admin->roles()->attach($adminRole);
        $this->actingAs($admin);
        $flights = Flight::factory()->create();
        Cache::shouldReceive('remember')->once()->andReturn($flights);
        $response = $this->get('/api/flights');
        $response->assertStatus(201);
    }

    public function testStore()
    {
        $this->withoutExceptionHandling();
        $admin = User::factory()->create();
        $adminRole = Role::factory()->create(['name' => 'admin']);
        $admin->roles()->attach($adminRole);
        $this->actingAs($admin);

        $flightData = [
            'name' => 'Test Flight',
        ];

        $response = $this->post('/api/flights', $flightData);
        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                        'name' => 'Test Flight'
                ],
            ]);
    }

    public function testShow()
    {
        $this->withoutExceptionHandling();
        $admin = User::factory()->create();
        $adminRole = Role::factory()->create(['name' => 'admin']);
        $admin->roles()->attach($adminRole);
        $this->actingAs($admin);
        $flight = Flight::factory()->create();
        Cache::shouldReceive('remember')->once()->andReturn($flight);
        $response = $this->get('/api/flights/' . $flight->id);
        $response->assertStatus(201)
            ->assertJson([
                'id' => $flight->id,
                'name' => $flight->name,
            ]);
    }

    public function testUpdate()
    {
        $this->withoutExceptionHandling();
        $admin = User::factory()->create();
        $adminRole = Role::factory()->create(['name' => 'admin']);
        $admin->roles()->attach($adminRole);
        $this->actingAs($admin);
        $this->withoutExceptionHandling();
        $flight = Flight::factory()->create();
        $updatedData = [
            'name' => 'Updated Flight',
        ];
        $response = $this->put('/api/flights/'.$flight->id, $updatedData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('flights', $updatedData);
    }

    public function testDestroy()
    {
        $this->withoutExceptionHandling();
        $admin = User::factory()->create();
        $adminRole = Role::factory()->create(['name' => 'admin']);
        $admin->roles()->attach($adminRole);
        $this->actingAs($admin);
        $flight = Flight::factory()->create();
        $response = $this->delete('/api/flights/'.$flight->id);
        $response->assertStatus(204);
        $this->assertSoftDeleted('flights', ['id' => $flight->id]);
    }
}
