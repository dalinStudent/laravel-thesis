<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{

    protected $table = 'borrowing';
    protected $fillable = [
        'id',
        'user_id',
        'qty',
        'start_datetime',
        'end_datetime',
        'status',
        'room_id',
        'product_id',
        'return_qty'
    ];  
   
   
}
