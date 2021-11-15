<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';
    protected $fillable = [
        'id',
        'name',
        'khmer_name',
        'model',
        'serialnumber',
        'category_id',
        'note',
        'qty',
    ];  

    const RELATION_METHOD = ["category","borrowing"];
    
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function borrowing()
    {
        return $this->hasMany(Borrowing::class);
    }
   
}
