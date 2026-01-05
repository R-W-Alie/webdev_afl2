<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'address',
        'city',
        'phone',
        'email',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_store');
    }
}
