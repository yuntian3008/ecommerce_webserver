<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'desc', 'slug'
    ];

    protected $appends = [
        'url'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getUrlAttribute()
    {
        return route('category',['category' => $this->slug]);
    }
}
