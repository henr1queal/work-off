<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::create([
            'price' => 19.99,
            'days' => 90
        ]);

        Plan::create([
            'price' => 16.99 * 3,
            'days' => 90
        ]);

        Plan::create([
            'price' => 14.99 * 12,
            'days' => 365
        ]);
    }
}
