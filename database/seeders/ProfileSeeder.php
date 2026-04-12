<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        profile::create([
        'full_name' => 'Ari Kusumastuti M.Pd M.Si',
        'birth_place_date' => 'Malang, 1 Januari 2000',
        'description' => 'Saya adalah seorang programmer yang fokus pada pengembangan aplikasi multi-platform menggunakan Flutter dan Laravel.',
        'vision' => 'Menjadi pengembang solusi digital yang memberikan dampak positif bagi masyarakat.',
        'mission' => 'Membangun sistem informasi yang efisien, aman, dan mudah digunakan oleh semua kalangan.',
        'profile_category' => 'Pegawai'
        ]);
    }
}
