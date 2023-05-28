<?php

namespace Database\Seeders;

use App\Models\Flight;
use App\Models\Hotel;
use App\Models\Location;
use App\Models\Tour;
use App\Models\TravelOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TravelOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $flights = Flight::all();
        $hotels = Hotel::all();
        $tours = Tour::all();
        $locations = Location::all();

        $travel_options = [];

        $commonData = [
            'start_date' => '2023-05-27',
            'end_date' => '2023-12-27',
            'deleted_at' => null
        ];

        foreach ($locations as $location) {
            foreach ($flights as $flight) {
                $travel_options[] = [
                    'type' => 'flight',
                    'travellable_id' => $flight->id,
                    'travellable_type' => 'App\Models\Flight',
                    'location_id' => $location->id,
                    'price' => rand(10000, 99999) / 100,
                    ...$commonData
                ];
            }

            foreach ($hotels as $hotel) {
                $travel_options[] = [
                    'type' => 'hotel',
                    'travellable_id' => $hotel->id,
                    'travellable_type' => 'App\Models\Hotel',
                    'location_id' => $location->id,
                    'price' => rand(10000, 99999) / 100,
                    ...$commonData
                ];
            }

            foreach ($tours as $tour) {
                $travel_options[] = [
                    'type' => 'tour',
                    'travellable_id' => $tour->id,
                    'travellable_type' => 'App\Models\Tour',
                    'location_id' => $location->id,
                    'price' => rand(10000, 99999) / 100,
                    ...$commonData
                ];
            }
        }
        TravelOption::insert($travel_options);
    }
}
