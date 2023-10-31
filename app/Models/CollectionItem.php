<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionItem extends Model
{
    use HasFactory;

    protected $table = 'collection_items'; 

    protected $fillable = [
        'collection_id',
        'item_id',
    ];

    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id');
    }

    public function item()
{
    return $this->belongsTo(Item::class, 'item_id');
}
}
