<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userIvan = User::factory()->create(['password' => Hash::make(12345678)]);
        $userSergey = User::factory()->create(['password' => Hash::make(12345678)]);

        News::factory()
            ->count(20)
            ->create(['owner_id' => $userIvan]);

        News::factory()
        ->count(20)
        ->create(['owner_id' => $userSergey]);
    }
}
