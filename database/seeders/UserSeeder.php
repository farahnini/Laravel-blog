<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create demo users
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole('admin');

        $editor = User::firstOrCreate(
            ['email' => 'editor@example.com'],
            [
                'name' => 'Editor User',
                'password' => Hash::make('password'),
            ]
        );
        $editor->assignRole('editor');

        $reader = User::firstOrCreate(
            ['email' => 'reader@example.com'],
            [
                'name' => 'Reader User',
                'password' => Hash::make('password'),
            ]
        );
        $reader->assignRole('reader');
    }
} 