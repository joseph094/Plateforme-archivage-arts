<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'artwork_id',
        'institution',
        'exhibition_title',
        'departure_date',
        'return_date',
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
