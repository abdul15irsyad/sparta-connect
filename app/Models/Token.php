<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'used_at',
        'expired_at',
        'created_at',
        'updated_at',
    ];

    public function tokenable()
    {
        return $this->morphTo();
    }
}
