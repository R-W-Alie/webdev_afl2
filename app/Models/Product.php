<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock_quantity',
        'is_featured',
    ];

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'product_store');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'product_user');
    }

        public function category()
    {
        return $this->belongsTo(Category::class);
    }

        public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

        public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }

        public function reviews()
    {
        return $this->hasMany(Review::class);
    }

        public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

        public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

        public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

        public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }
    
}
