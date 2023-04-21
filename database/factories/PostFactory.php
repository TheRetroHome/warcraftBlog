<?php

namespace Database\Factories;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'title'=>$this->faker->words(3,true),
            'description'=>$this->faker->paragraph(1),
            'content'=>$this->faker->words(10,true),
            'category_id'=>$this->faker->numberBetween(1,3),
        ];
    }
}
