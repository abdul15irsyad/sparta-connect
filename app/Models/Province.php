<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function regencies()
    {
        return $this->hasMany(Regency::class);
    }

    public function users()
    {
        return $this->hasManyThrough(User::class, Address::class);
    }
}
