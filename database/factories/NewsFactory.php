<?php

namespace Database\Factories;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'owner_id' => User::factory(),
            'code' => $this->faker->unique()->text(5),
            'title' => $this->faker->title(),
            'short_message' => $this->faker->words(10, true),
            'message' => $this->faker->sentence(),
            'approved' => true,
        ];
    }
}
