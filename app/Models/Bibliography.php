<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bibliography extends Model
{
    use HasFactory;

    protected $fillable = [
        'artwork_id',
        'book_title',
        'author_name',
        'publication_date',
        'page',
        'publisher',
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
