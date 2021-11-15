<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';
    protected $fillable = [
        'id',
        'name',
        'description'

    ];
    public $timestamps = true;
    public function borrowing()
    {
        return $this->hasMany(Borrowing::class, 'room_id');
    }
}
