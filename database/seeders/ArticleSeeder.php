<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Database\Eloquent\Collection;

class ArticleSeeder extends Seeder
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
        $tags = Tag::factory()->count(5)->create();

        $bindTags = fn (Article $article, Collection $tags) => $tags->each(fn(Tag $tag) => $article->tags()->attach($tag->id));

        /**
         * @var Collection $articles
         */
        $articles = Article::factory()
                ->count(10)
                ->create(['owner_id' => $userIvan->id]);
        $articles->each(fn (Article $article) => $bindTags($article, $tags->random(rand(1, 5))));

        $articles = Article::factory()
                ->count(10)
                ->create(['owner_id' => $userSergey->id]);
            
        $articles->each(fn (Article $article) => $bindTags($article, $tags->random(rand(1, 5))));
    }
}
