<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReviewImage;
use App\Models\OrderItem;
use App\Models\Product;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'stars', 'comment'
    ];

    public function reviewImages()
    {
        return $this->hasMany(ReviewImage::class);
    }

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function product()
    {
        return $this->hasOneThrough(Product::class, OrderItem::class);
    }
}
