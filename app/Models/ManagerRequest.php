<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagerRequest extends Model
{
    use HasFactory;
    protected $table = 'manager_request'; 

    protected $fillable = [
        'user_id',
        'store_name',
        'description',
    ];
}
