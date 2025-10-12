<?php

namespace App\Models;

class Product
{
    public static function all()
    {
        return [
            [
                'id' => 1,
                'name' => 'Linen Oversized Shirt',
                'price' => 499000,
                'description' => 'An airy oversized shirt made from 100% premium linen, designed for timeless comfort.',
                'main_image' => 'images/shirt1.jpg',
                'gallery' => ['images/shirt1.jpg', 'images/shirt2.jpg', 'images/shirt3.jpg'],
            ],
            [
                'id' => 2,
                'name' => 'Wool Blazer Classic Fit',
                'price' => 899000,
                'description' => 'Classic wool blazer with a tailored silhouette and soft shoulder line.',
                'main_image' => 'images/blazer1.jpg',
                'gallery' => ['images/blazer1.jpg', 'images/blazer2.jpg'],
            ],
            [
                'id' => 3,
                'name' => 'Minimal Tote Bag',
                'price' => 299000,
                'description' => 'Simple canvas tote for everyday essentials.',
                'main_image' => 'images/bag1.jpg',
                'gallery' => ['images/bag1.jpg', 'images/bag2.jpg'],
            ],
        ];
    }
}
