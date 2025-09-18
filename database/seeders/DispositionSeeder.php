<?php

namespace Database\Seeders;

use App\Models\Disposition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DispositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Delete existing data to avoid duplicates if seeder is run again
        Disposition::query()->delete();

        Disposition::factory()->count(15)->create();
    }
}
