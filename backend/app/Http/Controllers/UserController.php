<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    public function lastOnline($id)
    {
        $folderPath = public_path("pictures/{$id}");
        $filePath = $folderPath . '/last_online';

        if (!File::exists($folderPath)) {
            return response()->json(['error' => 'Folder not found'], 404);
        }

        if (!File::exists($filePath)) {
            // Create the file if it doesn't exist and set its timestamp to the folder's last modified date
            touch($filePath, File::lastModified($folderPath));
        }

        $lastModified = Carbon::createFromTimestamp(File::lastModified($filePath));
        $now = Carbon::now();
        $differenceInSeconds = abs($now->diffInSeconds($lastModified));
        $minutes = floor($differenceInSeconds / 60);
        $seconds = $differenceInSeconds % 60;

        // Determine color and text based on time difference

        if ($differenceInSeconds >= 400) {
            $days = floor($differenceInSeconds / 86400);
            if ($days == 0) {
                $onlineMessage = "OFFLINE RECENTLY";
            } elseif ($days == 1) {
                $onlineMessage = "OFFLINE 1 Day";
            } else {
                $onlineMessage = "OFFLINE {$days} Days";
            }
            $color = 'red';
        } else {
            $formattedDifference = sprintf("%02d:%02d", $minutes, $seconds);

            if ($differenceInSeconds >= 300) {
                $color = 'orange';
                $onlineMessage = "RECENT $formattedDifference";
            } else {
                $color = 'green';
                $onlineMessage = "ONLINE $formattedDifference";
            }
        }

        return response()->json([
            'userId' => $id,
            'lastOnline' => $lastModified->toDateTimeString(),
            'onlineMessage' => $onlineMessage,
            'color' => $color
        ]);
    }

    // Display a listing of the users.

    public function index()
    {
        return User::all();
    }

    // Store a newly created user in storage.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($user, 201);
    }

    // Display the specified user.

    public function indexWithProfiles()
    {
        // Fetch all users with their profiles 

        $users = User::with('profile')->get(); // Return the users as a JSON response 

        return response()->json($users);
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    // Update the specified user in storage.
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|string|min:8',
        ]);

        $user->update($request->all());

        return response()->json($user);
    }

    // Remove the specified user from storage.
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(null, 204);
    }
}
