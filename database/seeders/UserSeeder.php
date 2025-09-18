<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Delete existing data to avoid duplicates if seeder is run again
        User::query()->delete();

        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'phone' => '082121212121',
            'password' => Hash::make('admin'),
            'role' => Role::ADMIN->status(),
        ]);
    }
}
