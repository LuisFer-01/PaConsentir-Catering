<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Luis Fernando',
            'lastname' => 'Camacho Ballivian',
            'email' => 'admin@paconsentir.com',
            'password' => Hash::make('admin123'),
            'phone' => '04141234567',
            'ci' => 'V-98765432',
            'address' => 'Oficina Central',
            'rol_id' => 1,
            'estado' => 1
        ]);
    }
}
