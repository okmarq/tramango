<?php

namespace Database\Seeders;

use App\Models\Tour;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Tours = [
            [
                'name' => strtolower('O2 Arena')
            ],
            [
                'name' => strtolower('Gino Paradise')
            ],
            [
                'name' => strtolower('Mitsaminda Park')
            ],
            [
                'name' => strtolower('Vegas Casino')
            ]
        ];
        Tour::insert($Tours);
    }
}
