<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;//
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'users';
    protected $fillable = [
        'username', 
        'password',
        'employee_id',
        'role'
    ];

    protected $hidden = [
        'username','password', 'remember_token', 'created_at', 'updated_at', 'id', 'related_id'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    // public function creator()
    // {
    //     return $this->belongsTo(Employee::class, 'creator_id');
    // }
}
