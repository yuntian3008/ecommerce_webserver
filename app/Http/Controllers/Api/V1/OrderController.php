<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        request()->validate([
            'state' => ['nullable','in:0,1,2,3,4,5'],
            'all' => ['nullable', 'boolean']
        ]);


        if(request()->get('all', false)) {
            return response()->json(Order::all(), Response::HTTP_OK);
        }

        $numOfPage = 5;
        $state = request('state');


        $order = Order::with(['orderItems.product','address']);

        if (request()->has('state'))
            $order = $order->where('state',intval($state));
            // $order->where(function ($query) use($search) {
            //     $query
            //     ->where('name','like',"%{$search}%")
            //     ->orWhere('desc','like',"%{$search}%");
            // });


        $order = $order->paginate($numOfPage);

        $order->withQueryString();
        return response()->json($order, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order->address;
        $order->orderItems;
        foreach ($order->orderItems as &$value) {
            $value->product->category;
        }


        // $order = $order->with(['address','orderItems.product.category'])->get();
        return response()->json($order, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order = $order->update($request->validated());
        return response()->json($order, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
