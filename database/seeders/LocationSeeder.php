<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            [
                'name' => strtolower('Addis ababa')
            ],
            [
                'name' => strtolower('Georgia')
            ],
            [
                'name' => strtolower('Lagos')
            ]
        ];
        Location::insert($locations);
    }
}
