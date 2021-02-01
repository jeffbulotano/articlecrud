<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
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
            'client_name' => $this->faker->name,
            'client_email' => $this->faker->unique()->safeEmail,
            'required_wordcount' => 100,
            'article' => $this->faker->paragraph
        ];
    }
}
