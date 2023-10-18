<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'birth_place',
        'death_date',
        'death_place',
        'nationality',
        'biography',
        'user_id',
    ];
    protected $guarded = ['id'];

    public function artworks()
    {
        return $this->hasMany(Artwork::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
