<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRolePermission extends Model
{
    protected $table = 'admin_permission_admin_role';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function admin_role()
    {
        return $this->belongsTo(AdminRole::class);
    }

    public function admin_permission()
    {
        return $this->belongsTo(AdminPermission::class);
    }
}
