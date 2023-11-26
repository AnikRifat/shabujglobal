<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->hasOne(Role::class);
    }

    public function permissions()
    {
        $role = Role::where('name', $this->role)->first();

        return $role->permissions;
    }

    public function hasRole($roles)
    {

        if (count(array_intersect($roles, [$this->role])) > 0) {
            return true;
        }

    }

    public function hasPermission($permissions)
    {
        $permissionName = $this->permissions()->pluck('name')->toArray();
        if (count(array_intersect($permissions, $permissionName)) > 0) {
            return true;
        }
    }

    public function hasAnyRole(...$roles)
    {
        return $this->hasRole(...$roles);
    }
}
