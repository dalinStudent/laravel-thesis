<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'categories';
    protected $fillable = [
        'id',
        'name',
        'description'
    ];  
    public $timestamps = false;

    const RELATION_METHOD = ["category","product"];
   
    public function product()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
