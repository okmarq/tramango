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
                'name' => strtolower('Tbilisi')
            ],
            [
                'name' => strtolower('Lagos')
            ],
            [
                'name' => strtolower('Las Vegas')
            ]
        ];
        Location::insert($locations);
    }
}
