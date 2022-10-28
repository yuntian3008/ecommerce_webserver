<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\ProductImage;
use App\Models\Review;




class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'desc', 'slug', 'spesc', 'unit_price'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function reviews()
    {
        return $this->hasManyThrough(Review::class, OrderItem::class);
    }
}
