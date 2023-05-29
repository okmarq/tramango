<?php

namespace Database\Factories;

use App\Models\Flight;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TravelOption>
 */
class TravelOptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $flight = Flight::factory()->create();
        $location = Location::factory()->create();
        return [
            'type' => 'flight',
            'travellable_id' => $flight->id,
            'travellable_type' => Flight::class,
            'location_id' => $location->id,
            'start_date' => now()->toDateString(),
            'end_date' => now()->addDays(7)->toDateString(),
            'price' => 100.00
        ];
    }
}
