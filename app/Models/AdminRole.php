<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
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

    public function users()
    {
        return $this->hasMany(AdminUser::class);
    }

    public function admin_permissions()
    {
        return $this->belongsToMany(AdminPermission::class);
    }

    public function role_permissions()
    {
        return $this->hasMany(AdminRolePermission::class);
    }
}
