<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_has_permission', 'role_id', 'permission_id');
    }

    public function hasPermissionTo($id)
    {
        $permission = Permission::find($id);

        return $this->permissions->contains($permission);
    }

    public function givePermissionTo($permissions)
    {
        $this->permissions()->syncWithoutDetaching($permissions);
    }

    public function syncPermissions(array $permissions)
    {
        $this->permissions()->sync($permissions);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($role) {
            $role->permissions()->detach();
        });
    }
}
