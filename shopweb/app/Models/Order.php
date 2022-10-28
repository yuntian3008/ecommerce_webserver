<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use App\Models\Address;
use App\Models\User;



class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_amount', 'state'
    ];

    public function orderitems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function user()
    {
        return $this->hasOneThrough(User::class, Address::class);
    }
}
