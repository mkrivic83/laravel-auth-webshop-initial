<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@tester.com',
            'password' => Hash::make('admin1234'),
            'isAdmin' => true,
            'datum_rod' => '1980-01-15',
            'placa' => 3500
        ]);

        User::create([
            'name' => 'Pero Horvat',
            'email' => 'pero@tester.com',
            'password' => Hash::make('pero1234'),
            'isAdmin' => false,
            'datum_rod' => '1990-03-22',
            'placa' => 1800
        ]);

        User::create([
            'name' => 'Ivan Ivić',
            'email' => 'ivan@tester.com',
            'password' => Hash::make('ivan1234'),
            'isAdmin' => false,
            'datum_rod' => '1992-10-15',
            'placa' => 1900
        ]);
    }
}
