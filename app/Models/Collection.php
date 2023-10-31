<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $table = 'collections'; 

    protected $fillable = [
        'user_id',
        'collection_name',
    ];

    public function user()
    {
    return $this->belongsTo(User::class);
    }
    
    public function items()
    {
    return $this->belongsToMany(Item::class, 'collection_items', 'collection_id', 'item_id');
    }
}
