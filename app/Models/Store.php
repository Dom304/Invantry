<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'manager_id',
        'store_name',
        'store_description',
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
