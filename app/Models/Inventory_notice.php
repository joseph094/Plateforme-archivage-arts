<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory_notice extends Model
{
    use HasFactory;

    protected $fillable = [
        'artwork_id',
        'editor_name',
    ];
    protected $guarded = ['id'];

    public function artwork()
    {
        return $this->belongsTo(Artwork::class);
    }
}
