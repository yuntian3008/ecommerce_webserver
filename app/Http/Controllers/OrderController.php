<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class OrderController extends Controller
{

    public function index(Request $request) {
        $orders = $request->user()->orders()->with('orderitems')->paginate(8);
        // foreach ($orders->data as $value) {
        //     $order->da
        // }
        if ($request->wantsJson())
            return $orders;

        return Inertia::render('Shop/Orders',[
            'orders' => $orders,
        ]);
    }


    public function store(StoreOrderRequest $request, Address $address)
    {


        $orderItems = $request->safe()->order_items;

        $totalAmount = 0;

        foreach ($orderItems as $index => &$value) {
            $value['unit_price'] = Product::find($value['id'])->unit_price;
            $totalAmount +=  $value['unit_price'] * $value['quantity'];
        }


        $order = $address->orders()->create([
            'total_amount' => $totalAmount,
            'state' => 1,
        ]);

        foreach ($orderItems as $index => &$value) {
            $order->products()->attach($value['id'], [
                'final_unit_price' => $value['unit_price'],
                'quantity' => $value['quantity']
            ]);
        }

        return Redirect::route('order.show',['order' => $order->id]);

    }

    public function show(Order $order)
    {
        $items = $order->orderitems;
        foreach ($items as $item) {
            $item->product->category;
        }
        if ($order->address->user->id != request()->user()->id)
            abort(404);
        return Inertia::render('Shop/OrderDetail',[
            'order' => $order
        ]);
    }
}
