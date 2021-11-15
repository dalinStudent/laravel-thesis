<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departments extends Model
{
    use SoftDeletes;

    protected $table = 'departments';
    protected $fillable = [
        'id',
        'name',
        'description'
    ];  
    public $timestamps = false;

    public function student()
    {
        return $this->hasMany(Students::class, 'department_id');
    }

}
