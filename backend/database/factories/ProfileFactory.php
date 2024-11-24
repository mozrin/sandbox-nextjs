<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition()
    {
        return [
            'handle' => $this->faker->unique()->userName,
            'intro' => $this->faker->sentence,
            'bio' => $this->faker->paragraph,
            'gender' => $this->faker->numberBetween(1, 3),
            'birthday' => $this->faker->date,
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'photo_default' => 1, // Default photo
            'photo1' => null,
            'photo2' => null,
            'photo3' => null,
            'photo4' => null,
            'photo5' => null,
            'photo6' => null,
            'photo7' => null,
            'photo8' => null,
            'photo9' => null,
            'photo10' => null,
            'photo11' => null,
            'photo12' => null,
            'photo13' => null,
            'photo14' => null,
            'photo15' => null,
            'photo16' => null,
            'photo17' => null,
            'photo18' => null,
            'photo19' => null,
            'photo20' => null,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Profile $profile) {
            $folderPath = public_path("pictures/{$profile->id}");
            $photos = $this->getPhotosFromFolder($folderPath);

            // Update profile with photos
            $profile->update([
                'photo1' => $photos[0] ?? null,
                'photo2' => $photos[1] ?? null,
                'photo3' => $photos[2] ?? null,
                'photo4' => $photos[3] ?? null,
                'photo5' => $photos[4] ?? null,
                'photo6' => $photos[5] ?? null,
                'photo7' => $photos[6] ?? null,
                'photo8' => $photos[7] ?? null,
                'photo9' => $photos[8] ?? null,
                'photo10' => $photos[9] ?? null,
                'photo11' => $photos[10] ?? null,
                'photo12' => $photos[11] ?? null,
                'photo13' => $photos[12] ?? null,
                'photo14' => $photos[13] ?? null,
                'photo15' => $photos[14] ?? null,
                'photo16' => $photos[15] ?? null,
                'photo17' => $photos[16] ?? null,
                'photo18' => $photos[17] ?? null,
                'photo19' => $photos[18] ?? null,
                'photo20' => $photos[19] ?? null,
            ]);
        });
    }

    /**
     * Get photos from the specified folder.
     *
     * @param string $path
     * @return array
     */
    private function getPhotosFromFolder(string $path): array
    {
        if (!File::exists($path) || !File::isDirectory($path)) {
            return [];
        }

        // Get all files in the directory
        $files = File::files($path);

        // Sort files by name
        usort($files, function ($a, $b) {
            return strcmp($a->getFilename(), $b->getFilename());
        });

        // Map file paths to public URLs
        $photos = array_map(function ($file) use ($path) {
            return url("pictures/" . basename($path) . "/" . $file->getFilename());
        }, $files);

        return $photos;
    }
}
