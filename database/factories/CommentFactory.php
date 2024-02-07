<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $commentableType = $this->faker->randomElement(['App\Models\Post', 'App\Models\Video']);

        if ($commentableType === 'App\Models\Post') {
            $commentable_id = Post::pluck('id')->random();
        } else {
            $commentable_id = Video::pluck('id')->random();
        }

        return [
            'user_id' => User::pluck('id')->random(),
            'commentable_type' =>  $commentableType,
            'commentable_id' => $commentable_id,
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph()
        ];
    }
}
