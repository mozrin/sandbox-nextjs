<?php

namespace Database\Factories;

use App\Models\Photo;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoFactory extends Factory
{
    protected $model = Photo::class;

    public function definition()
    {
        return [
            'profile_id' => \App\Models\Profile::factory(),
            'title' => $this->faker->sentence,
            'path' => $this->faker->imageUrl(),
            'approved' => $this->faker->boolean,
            'verified' => $this->faker->boolean,
            'blocked' => $this->faker->boolean,
            'details' => $this->faker->paragraph,
            'system_notes' => $this->faker->paragraph,
        ];
    }
}
