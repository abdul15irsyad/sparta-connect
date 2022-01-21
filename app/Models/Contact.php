<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
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

    public function contact_type()
    {
        return $this->belongsTo(ContactType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
