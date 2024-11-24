<?php

use Illuminate\Support\Facades\Route;

// Catch-all route that returns a 404 response

Route::fallback(function () {
    return response()->json(['message' => 'Not Found w'], 404);
});
