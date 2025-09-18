<?php

namespace Database\Seeders;

use App\Models\Letter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LetterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Delete existing data to avoid duplicates if seeder is run again
        Letter::query()->delete();

        Letter::factory()->count(50)->create();
    }
}
