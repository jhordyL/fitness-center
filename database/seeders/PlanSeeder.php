<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        Plan::updateOrCreate(
            ['name' => 'Plan mensual'],
            [
                'duration_days' => 30,
                'price' => 80.00,
                'description' => 'Membresía válida por 30 días.',
                'status' => 'active',
            ]
        );

        Plan::updateOrCreate(
            ['name' => 'Plan trimestral'],
            [
                'duration_days' => 90,
                'price' => 210.00,
                'description' => 'Membresía válida por 90 días.',
                'status' => 'active',
            ]
        );

        Plan::updateOrCreate(
            ['name' => 'Plan anual'],
            [
                'duration_days' => 365,
                'price' => 720.00,
                'description' => 'Membresía válida por 365 días.',
                'status' => 'active',
            ]
        );
    }
}
