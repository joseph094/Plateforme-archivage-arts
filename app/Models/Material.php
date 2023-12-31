<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
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
