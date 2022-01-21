<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }

    public function users()
    {
        return $this->hasManyThrough(User::class, Address::class);
    }
}
