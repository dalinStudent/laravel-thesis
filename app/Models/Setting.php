<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'settings';
    protected $fillable = [
        'object_id',
        'object_type',
        'feature',
        'value'
    ];
    const OBJECT_TYPE_COMPANY = 'company';
    const OBJECT_TYPE_PROJECT = 'project';
    const OBJECT_TYPE_EMPLOYEE = 'employee';
    const FEATURE_CARD = 'card';
}
