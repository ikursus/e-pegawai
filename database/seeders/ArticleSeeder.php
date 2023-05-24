<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Dapatkan SEMUA senarai users di dalam database dan pilih ID mereka sahaja
        // Convert data dari collection kepada array
        $senaraiUsers = User::pluck('id')->toArray();

        // Loopkan 100 artikel
        for ($i = 0; $i < 100; $i++)
        {
            // Dapatkan ID user secara random dari senarai user
            $randomUserKey = array_rand($senaraiUsers);

            // Cipta artikel baru dan masukkan ID user yang dipilih secara random
            Article::create([
                'user_id' => $senaraiUsers[$randomUserKey],
                'tajuk' => $faker->sentence,
                'kandungan' => $faker->paragraph,
                'status' => $faker->randomElement(['draft', 'published'])
            ]);
        }
    }
}
