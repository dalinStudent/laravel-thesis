<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $table = 'students';
    protected $fillable = [
        'id',
        'name',
        'idcard',
        'department_id',
        'shift',
        'year',
        'phonenumber1',
        'phonenumber2',
        'DOB',
        'Living_Location',
        'gender'
    ];
    public $timestamps = false;

    
    const RELATION_METHOD = ["student","borrowing"];
    public function borrowing()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function department()
    {
        return $this->belongsTo(Departments::class);
    }
}

