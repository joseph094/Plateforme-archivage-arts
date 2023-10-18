<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    use HasFactory;

     protected $fillable = [
        'inventory_number',
        'type',
        'title',
        'artist_id',
        'material_id',
        'support',
        'height',
        'width',
        'depth',
        'weight',
        'elements_number',
        'print_number',
        'print_type',
        'description',
        'signature',
        'signature_location',
        'conservation_location',
        'storage_place',
        'storage_method',
        'user_id',
    ];
    protected $guarded = ['id'];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
    public function material()
    {
        return $this->belongsTo(Material::class);
    }
    public function acquisition()
    {
        return $this->hasOne(Acquisition::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function restoration()
    {
        return $this->hasMany(Restoration::class);
    }
    public function reservation()
    {
        return $this->hasMany(Reservation::class);
    }
    public function exhibition()
    {
        return $this->hasMany(Exhibition::class);
    }

    public function bibliography()
    {
        return $this->hasMany(Bibliography::class);
    }

    public function loan()
    {
        return $this->hasMany(Loan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
