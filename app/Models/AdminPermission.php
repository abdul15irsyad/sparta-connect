<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminPermission extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function admin_roles()
    {
        return $this->belongsToMany(AdminRole::class, 'admin_permission_admin_role');
    }

    public function role_permission()
    {
        return $this->hasMany(AdminRolePermission::class);
    }
}
