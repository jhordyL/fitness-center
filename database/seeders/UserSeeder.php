<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@fitnesscenter.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'recepcion@fitnesscenter.com'],
            [
                'name' => 'Recepción',
                'password' => Hash::make('password123'),
                'role' => 'recepcion',
            ]
        );
    }
}
