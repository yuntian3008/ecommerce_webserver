<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;

class ReviewImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'path'
    ];

    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}
