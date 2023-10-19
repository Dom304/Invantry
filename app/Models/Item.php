<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    
    protected $table = 'items'; 

    protected $fillable = [
        'store_id',
        'item_name',
        'item_description',
        'item_quantity',
        'item_price',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}

