<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exhibition extends Model
{
    use HasFactory;

    protected $fillable = [
        'artwork_id',
        'specific_constraints',
        'exhibition_title',
        'exhibition_location',
        'start_date',
        'end_date',
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
