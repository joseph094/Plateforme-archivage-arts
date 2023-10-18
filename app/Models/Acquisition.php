<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Acquisition extends Model
{
    use HasFactory;
    protected $fillable = [
        'artwork_id',
        'current_owner',
        'acquisition_date',
        'acquisition_location',
        'price',
        'acquisition_method',
        'proof_of_purchase',
        'authenticity_certificate',
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
