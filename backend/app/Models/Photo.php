<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'title',
        'path',
        'approved',
        'verified',
        'blocked',
        'details',
        'system_notes',
    ];

    /**
     * Get the profile that owns the photo.
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
