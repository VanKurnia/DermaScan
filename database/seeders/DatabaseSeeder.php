<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Ivan Kurniawan (Van)',
            'email' => 'ivankurniawan474@gmail.com',
            'email_verified_at' => now(),
            // 'password' => '$2y$12$deDI3VV/5LAU6L9gzKGqCu98gZz2DWKZGw7zUOS27F0hi5rF/1iM6',
            'password' => Hash::make('IvanKurniawan070'),
            'google_id' => '117348572025608509171',
            'google_avatar' => 'https://lh3.googleusercontent.com/a/ACg8ocLYH5-LIl-LQXcIeRRc6Z5tEYSBdSEA5tDLuoEV0MYk9qWCIwsR=s96-c',
        ]);
    }
}
