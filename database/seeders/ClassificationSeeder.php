<?php

namespace Database\Seeders;

use App\Models\Classification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Hapus data lama agar tidak duplikat jika seeder dijalankan lagi
        Classification::query()->delete();

        Classification::create([
            'code' => 'UMM',
            'type' => 'Umum',
            'description' => 'Surat-surat umum yang tidak termasuk dalam kategori lain.',
        ]);

        Classification::create([
            'code' => 'UND',
            'type' => 'Undangan',
            'description' => 'Surat yang berisi undangan untuk menghadiri acara, rapat, atau kegiatan lainnya.',
        ]);

        Classification::create([
            'code' => 'PEG',
            'type' => 'Kepegawaian',
            'description' => 'Surat yang berkaitan dengan data pegawai, cuti, mutasi, dan SK.',
        ]);

        Classification::create([
            'code' => 'KEU',
            'type' => 'Keuangan',
            'description' => 'Surat yang berkaitan dengan anggaran, pembayaran, dan laporan keuangan.',
        ]);

        Classification::create([
            'code' => 'TIK',
            'type' => 'Teknologi Informasi',
            'description' => 'Surat yang berkaitan dengan infrastruktur jaringan, software, dan hardware.',
        ]);

        Classification::create([
            'code' => 'HKM',
            'type' => 'Hukum',
            'description' => 'Surat yang berkaitan dengan peraturan, produk hukum, dan legalitas.',
        ]);

        Classification::create([
            'code' => 'HUM',
            'type' => 'Hubungan Masyarakat',
            'description' => 'Surat untuk siaran pers, konfirmasi media, dan komunikasi eksternal lainnya.',
        ]);
    }
}

