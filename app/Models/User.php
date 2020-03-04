<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
/**
 * Class User
 * @package App\Models
 * @property int id
 * @property string name
 * @property string email
 * @property string password
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;


    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function posts()
    {
        return $this-> hasMany(Post::class);
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

}
