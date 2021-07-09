<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Database\Eloquent\Collection;

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

                /**
         * @var Collection $tags
         */
        $tags = Tag::get();

        $bindTags = fn (News $article, Collection $tags) => $tags->each(fn(Tag $tag) => $article->tags()->attach($tag->id));

        $news = News::factory()
            ->count(20)
            ->create(['owner_id' => $userIvan]);
            $news->each(fn (News $news) => $bindTags($news, $tags->random(rand(1, 5))));

        $news = News::factory()
        ->count(20)
        ->create(['owner_id' => $userSergey]);
        $news->each(fn (News $news) => $bindTags($news, $tags->random(rand(1, 5))));
    }
}
