<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\Photo;
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
            // Removing 'photo_default' as we will set it dynamically
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Profile $profile) {
            $folderPath = public_path("pictures/{$profile->id}");
            $photos = $this->getPhotosFromFolder($folderPath);

            // Create photo records for the profile
            $createdPhotos = [];
            foreach ($photos as $path) {
                $photo = Photo::create([
                    'profile_id' => $profile->id,
                    'title' => $this->faker->sentence,
                    'path' => $path,
                    'approved' => $this->faker->boolean,
                    'verified' => $this->faker->boolean,
                    'blocked' => $this->faker->boolean,
                    'details' => $this->faker->paragraph,
                    'system_notes' => $this->faker->paragraph,
                ]);
                $createdPhotos[] = $photo;
            }

            // Set the first photo as the default photo
            if (!empty($createdPhotos)) {
                $profile->default_photo_id = $createdPhotos[0]->id;
                $profile->save();
            }
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
        // Check if the path exists and is a directory
        if (!File::exists($path) || !File::isDirectory($path)) {
            return [];
        }

        // Path to the last_online file
        $lastOnlinePath = $path . '/last_online';

        // Touch or create the last_online file
        if (!File::exists($lastOnlinePath)) {
            File::put($lastOnlinePath, '');
        } else {
            // Use file_put_contents to touch the file
            file_put_contents($lastOnlinePath, '', FILE_APPEND);
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
