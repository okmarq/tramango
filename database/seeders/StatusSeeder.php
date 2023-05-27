<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'name' => strtolower('approved')
            ],
            [
                'name' => strtolower('denied')
            ],
            [
                'name' => strtolower('pending')
            ],
            [
                'name' => strtolower('available')
            ],
            [
                'name' => strtolower('unavailable')
            ]
        ];
        Status::insert($statuses);
    }
}
