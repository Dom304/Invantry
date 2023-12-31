<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    
    protected $table = 'store'; 

    protected $fillable = [
        'store_name',
        'manager_id',
        'store_description',
        'store_logo',
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
    
    public function items()
{
    return $this->hasMany(Item::class, 'store_id');
}

}
