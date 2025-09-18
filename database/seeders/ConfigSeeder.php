<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Delete existing data to avoid duplicates if seeder is run again
        Config::query()->delete();

        Config::insert([
            [
                'code' => 'default_password',
                'value' => 'admin',
            ],
            [
                'code' => 'page_size',
                'value' => '5',
            ],
            [
                'code' => 'app_name',
                'value' => 'Aplikasi Disposisi Surat Diskominfo',
            ],
            [
                'code' => 'institution_name',
                'value' => 'Diskominfo Kota Semarang',
            ],
            [
                'code' => 'institution_address',
                'value' => 'Jl. Semarang',
            ],
            [
                'code' => 'institution_phone',
                'value' => '082121212121',
            ],
            [
                'code' => 'institution_email',
                'value' => 'admin@admin.com',
            ],
            [
                'code' => 'language',
                'value' => 'id',
            ],
            [
                'code' => 'pic',
                'value' => 'Jenna Jenkins',
            ],
        ]);
    }
}
