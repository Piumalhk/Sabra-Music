<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'index_no' => 'ADMIN001',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        
        // Create regular user
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'index_no' => 'USER001',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
