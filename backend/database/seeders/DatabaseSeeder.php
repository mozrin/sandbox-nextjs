<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use FileSystemIterator;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Test User - Mozrin
        User::factory()->create([
            'name' => 'Mozrin Caer',
            'email' => 'mozrin@mozrin.com',
            'password' => 'password',
        ]);

        // Get the number of folders in the public/pictures directory
        $folderPath = public_path('pictures');
        $folderCount = $this->countFolders($folderPath);

        // Create Random Users based on folder count
        User::factory()->count($folderCount)->create();
    }

    /**
     * Count the number of folders in the given directory.
     *
     * @param string $path
     * @return int
     */
    private function countFolders($path): int
    {
        $folders = new FileSystemIterator($path, FileSystemIterator::SKIP_DOTS);
        $folderCount = 0;

        foreach ($folders as $folder) {
            if ($folder->isDir()) {
                $folderCount++;
            }
        }

        return $folderCount;
    }
}
