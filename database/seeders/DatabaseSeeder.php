<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Admin SewaAja',
            'email' => 'admin@example.com',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Admin No. 1',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'nama' => 'Owner SewaAja',
            'email' => 'owner@example.com',
            'no_hp' => '081234567891',
            'alamat' => 'Jl. Owner No. 1',
            'password' => Hash::make('password'),
            'role' => 'owner',
        ]);

        User::create([
            'nama' => 'Customer SewaAja',
            'email' => 'customer@example.com',
            'no_hp' => '081234567892',
            'alamat' => 'Jl. Customer No. 1',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        // $this->call(Seeder::class);
    }
}
