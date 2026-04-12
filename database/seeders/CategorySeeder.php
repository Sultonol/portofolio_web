<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $portofolio = Category::create ([
            'name' => 'portofolio',
        ]);

        $profile = Category::create ([
            'name' => 'profile',
        ]);

        Category::create(['name' => 'pegawai', 'parent_id' => $portofolio->id]);
        Category::create(['name' => 'peneliti', 'parent_id' => $portofolio->id]);

        Category::create(['name' => 'pegawai', 'parent_id' => $profile->id]);
        Category::create(['name' => 'peneliti', 'parent_id' => $profile->id]);
    }
}
