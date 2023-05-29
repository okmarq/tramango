<?php

namespace Database\Seeders;

use App\Models\Flight;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $flights = [
            [
                'name' => strtolower('British Airways')
            ],
            [
                'name' => strtolower('Turkish Airways')
            ],
            [
                'name' => strtolower('Air Peace')
            ],
            [
                'name' => strtolower('Fly Emirates')
            ]
        ];
        Flight::insert($flights);
    }
}
