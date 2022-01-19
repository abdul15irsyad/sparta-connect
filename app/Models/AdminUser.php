<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    use Notifiable;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function admin_role()
    {
        return $this->belongsTo(AdminRole::class);
    }
}
