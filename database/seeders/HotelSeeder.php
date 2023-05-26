<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hotels = [
            [
                'name' => strtolower('Eko Atlantic'),
                'name' => strtolower('Le Meridien'),
                'name' => strtolower('Monty Suites')
            ]
        ];
        Hotel::insert($hotels);
    }
}
