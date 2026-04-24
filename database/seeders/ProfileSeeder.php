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
        // Cek apakah sudah ada profile, jika belum buat baru
        if (!Profile::first()) {
            Profile::create([
                'full_name' => 'Sultonol Auliya',
                'birth_place_date' => 'Jakarta, 15 Mei 1998',
                'description' => 'Saya adalah seorang programmer yang fokus pada pengembangan aplikasi multi-platform menggunakan Flutter dan Laravel.',
                'vision' => 'Menjadi pengembang solusi digital yang memberikan dampak positif bagi masyarakat dan industri teknologi.',
                'mission' => 'Membangun sistem informasi yang efisien, aman, dan mudah digunakan oleh semua kalangan dengan inovasi berkelanjutan.',
                'profile_category' => 'Programmer'
            ]);
        } else {
            // Jika sudah ada, update data visi dan misi
            Profile::first()->update([
                'vision' => 'Menjadi pengembang solusi digital yang memberikan dampak positif bagi masyarakat dan industri teknologi.',
                'mission' => 'Membangun sistem informasi yang efisien, aman, dan mudah digunakan oleh semua kalangan dengan inovasi berkelanjutan.'
            ]);
        }
    }
}
