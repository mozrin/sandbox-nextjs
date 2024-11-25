<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function show($id)
    {
        $photo = Photo::with('user')->findOrFail($id);

        return response()->json([
            'id' => $photo->id,
            'user_id' => $photo->user ? $photo->user->id : null,
            'profile_id' => $photo->profile_id,
            'title' => $photo->title,
            'path' => $photo->path,
            'approved' => $photo->approved,
            'verified' => $photo->verified,
            'blocked' => $photo->blocked,
            'details' => $photo->details,
            'system_notes' => $photo->system_notes,
            'created_at' => $photo->created_at,
            'updated_at' => $photo->updated_at,
        ]);
    }
}
