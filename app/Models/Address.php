<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'address_line1',
        'address_line2',
        'city',
        'postal_code',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function fullAddress()
    {
        return $this->address_line1 . ', ' . 
               ($this->address_line2 ? $this->address_line2 . ', ' : '') . 
               $this->city;
    }
}
