<?php

namespace Database\Seeders;

use App\Models\Period;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\Course;
use App\Models\Kategori;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Role::create([
            'role_name' => "superadmin"
        ]);
        Role::create([
            'role_name' => "admin"
        ]);
        Role::create([
            'role_name' => "teacher"
        ]);
        Role::create([
            'role_name' => "student"
        ]);

        Period::create([
            'period_name' => '2024/2025 Even'
        ]);
        Period::create([
            'period_name' => '2025/2026 Odd'
        ]);

        User::create([
            'name' => 'superadmin',
            'username' => 'superadmin',
            'password' => Hash::make('superadmin123'),
            'email' => 'superadmin@gmail.com',
            'role_id' => 1,
            'agurooz_id' => 1,
        ]);

        Kategori::create([
            'kategori' => 'UI/UX & Web Design',
            'slug' => Str::slug('UI/UX & Web Design'),
        ]);
        Kategori::create([
            'kategori' => 'Website Development',
            'slug' => Str::slug('Website Development'),
        ]);
        Kategori::create([
            'kategori' => 'Mobile Development',
            'slug' => Str::slug('Mobile Development'),
        ]);
        Kategori::create([
            'kategori' => 'Data Analysis',
            'slug' => Str::slug('Data Analysis'),
        ]);
        Kategori::create([
            'kategori' => 'Bahasa Asing',
            'slug' => Str::slug('Bahasa Asing'),
        ]);
        Kategori::create([
            'kategori' => 'Kreativitas & Desain',
            'slug' => Str::slug('Kreativitas & Desain'),
        ]);
        Kategori::create([
            'kategori' => 'Bisnis & Kewirausahaan',
            'slug' => Str::slug('Bisnis & Kewirausahaan'),
        ]);
        Kategori::create([
            'kategori' => 'Pengembangan Diri',
            'slug' => Str::slug('Pengembangan Diri'),
        ]);

        Course::factory()->count(2)->create();

    }
}
