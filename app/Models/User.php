<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // sistem token

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Kolom yang boleh diisi 
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', 
    ];

    /**
     * Kolom yang disembunyikan saat data dipanggil
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Format otomatis untuk kolom tertentu
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Password otomatis di-hash oleh Laravel
    ];
}