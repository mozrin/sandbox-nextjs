<?php

namespace Database\Factories;

use App\Models\Photo;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoFactory extends Factory
{
    protected $model = Photo::class;

    // Define probabilities as whole numbers

    private $approvedProbability = 95; // 95% chance to be approved
    private $verifiedProbability = 20; // 20% chance to be verified
    private $blockedProbability = 1;   // 1% chance to be blocked

    public function definition()
    {
        return [
            'profile_id' => \App\Models\Profile::factory(),
            'title' => $this->faker->sentence,
            'path' => $this->faker->imageUrl(),
            'approved' => $this->faker->numberBetween(1, 100) <= $this->approvedProbability,
            'verified' => $this->faker->numberBetween(1, 100) <= $this->verifiedProbability,
            'blocked' => $this->faker->numberBetween(1, 100) <= $this->blockedProbability,
            'system_notes' => $this->faker->paragraph,
        ];
    }
}
