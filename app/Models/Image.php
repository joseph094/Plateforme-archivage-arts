<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'artwork_id',
        'path',
        'copyright_notice',
        'photographic_rights',
        'user_id',
    ];
    protected $guarded = ['id'];

    public function artwork()
    {
        return $this->belongsTo(Artwork::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

