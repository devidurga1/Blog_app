<?php

namespace App\Models;
use Spatie\Permission\Models\Role;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\Access\Authorizable;    
use Laravel\Sanctum\HasApiTokens;


use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    //use HasApiTokens, HasFactory, Notifiable ,HasRoles, TwoFactorAuthenticatable ,CanResetPassword;
    use HasApiTokens;
    use Authorizable;      
    use HasFactory;
    use Notifiable ;
     use HasRoles;
     use CanResetPassword;
      


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
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


   /* public function hasRole($role)
{
    return $this->roles()->where('name', $role)->exists();
}*/

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

   /* public function getRole()
{
    return $this->role;
}
public function setRole($role)
{
    $this->role = $role;
    $this->save();
}
*/
  /* public function hasRole($role)
{
    return $this->role === $role;
}*/

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
