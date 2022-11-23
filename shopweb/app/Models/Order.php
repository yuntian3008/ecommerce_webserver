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

    protected $appends = [
        'state_name',
    ];

    public function getStateNameAttribute()
    {
        switch ($this->state) {
            case 0: return "Đơn hàng đã được hủy";
            case 1: return "Đơn hàng chờ xác nhận";
            case 2: return "Đơn hàng đã xác nhận";
            case 3: return "Đơn hàng đã đóng gói";
            case 4: return "Đơn hàng đang được giao";
            case 5: return "Đơn hàng đã giao thành công";
        }
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items');
    }

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

    protected $casts = [
        'created_at' => "datetime:H:i:s d/m/Y",
        'updated_at' => "datetime:H:i:s d/m/Y",
    ];
}
