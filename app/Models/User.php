<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    const ROLE_BUYER = 'buyer';
    const ROLE_MANAGER = "manager";
    const ROLE_MOD = "moderator";
    const ROLE_ADMIN = "admin";

    public function isAdmin(){
        return $this->role === 'admin';
    }
    public function isBuyer(){
        return $this->role === 'buyer';
    }
    public function isModerator(){
        return $this->role === 'moderator';
    }
    public function isManager(){
        return $this->role === 'manager';
    }

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password', 'role'];


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
        'password' => 'hashed',
        // 'collection_ids' => 'array',
    ];

    public function collections()
{
    return $this->hasMany(Collection::class);
}

    public function store(): HasOne
    {
        return $this->hasOne(Store::class, 'manager_id');
    }
}
