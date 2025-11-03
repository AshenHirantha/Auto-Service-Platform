<?php

// database/seeders/UserSeeder.php
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'hirantha8f@gmail.com',
            'password' => Hash::make('Ashen$123'),
            'is_active' => true,
            'user_type' => 'admin',
        ]);

        User::create([
            'name' => 'Customer One',
            'email' => 'customer1@example.com',
            'password' => Hash::make('password'),
            'is_active' => true,
            'user_type' => 'customer',
        ]);
            User::create([
            'name' => 'Admin User',
            'email' => 'ashen123@gmail.com',
            'password' => Hash::make('ashen$1234'),
            'is_active' => true,
            'user_type' => 'admin',
        ]);

            User::create([
            'name' => 'Vendor',
            'email' => 'vendortest@gmail.com',
            'password' => Hash::make('vendor$1234'),
            'is_active' => true,
            'user_type' => 'vendor',
        ]);
        // Add more users or other data as needed
    }
}