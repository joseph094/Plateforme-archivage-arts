<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restoration extends Model
{
    use HasFactory;
    protected $fillable = [
        'artwork_id',
        'diagnosis',
        'causes',
        'start_date',
        'end_date',
        'restoration_location',
        'restorer_name',
        'intervention_type',
        'materials_and_techniques',
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
