<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\ProductImage;



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
}
