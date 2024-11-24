<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display the authenticated user's profile.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function show()
    {
        // $user = Auth::user();
        $user = User::find(1);


        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $profile = $user->profile;

        return response()->json($profile, 200);
    }
}
