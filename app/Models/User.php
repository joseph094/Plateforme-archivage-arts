<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function material()
    {
        return $this->hasMany(Material::class);
    }
    public function acquisition()
    {
        return $this->hasMany(Acquisition::class);
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
    public function artwork()
    {
        return $this->hasMany(Artwork::class);
    }
    public function artist()
    {
        return $this->hasMany(Artist::class);
    }
}
