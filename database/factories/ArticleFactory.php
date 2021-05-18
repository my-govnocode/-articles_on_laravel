<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleFactory extends Factory
{
    use HasFactory;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'owner_id' => null,
            'code' => $this->faker->unique()->text(5),
            'title' => $this->faker->title(),
            'short_message' => $this->faker->words(10, true),
            'message' => $this->faker->sentence(),
            'approved' => true,
        ];
    }
}
