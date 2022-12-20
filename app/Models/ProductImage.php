<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'priority', 'path'
    ];

    protected $appends = [
        'url'
    ];

    public function getUrlAttribute()
    {
        return Storage::disk('product-image')->url($this->path);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
