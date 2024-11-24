<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

Route::get('/my-profile', [ProfileController::class, 'show']);

Route::get('/user/{id}/last_online', [UserController::class, 'lastOnline']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/usersWithProfiles', [UserController::class, 'indexWithProfiles']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Catch-all Route for API

Route::fallback(function () {
    return response()->json(['message' => 'Not Found'], 404);
});

// Hang on to this one in the event it is useful. It appears to be a bit more discriminating.
//
// Route::match(['get', 'post', 'put', 'delete', 'patch', 'options'], '{any}', function () {
//     return response()->json(['message' => 'Not Found'], 404);
// })->where('any', '.*');
