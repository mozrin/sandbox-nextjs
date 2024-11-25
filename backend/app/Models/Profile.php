<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'handle',
        'intro',
        'bio',
        'gender',
        'birthday',
        'city',
        'country',
        'photo1',
        'photo2',
        'photo3',
        'photo4',
        'photo5',
        'photo6',
        'photo7',
        'photo8',
        'photo9',
        'photo10',
        'photo11',
        'photo12',
        'photo13',
        'photo14',
        'photo15',
        'photo16',
        'photo17',
        'photo18',
        'photo19',
        'photo20',
        'photo_default',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
