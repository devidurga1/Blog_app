<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    //use HasApiTokens, HasFactory, Notifiable ,HasRoles, TwoFactorAuthenticatable;
    use HasApiTokens;
    use HasFactory;
    use Notifiable ;
     use HasRoles;
      


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /*public function roles(){
        return $this->belongsToMany(Role::class);
    }*/

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function hasPermissionsInRoles()
    {
        foreach ($this->roles as $role) {
            foreach ($role->permissions as $permission) {
                if ($this->hasPermissionTo($permission)) {
                    return true;
                }
            }
        }
        return false;
    }

}
