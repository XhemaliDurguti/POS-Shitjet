<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderStoreRequest;
use App\Models\Models\Order;


class OrderController extends Controller
{
    //
    public function index(Request $request) 
    {
        $orders = new Order();
        if($request->start_date) {
            $orders = $orders->where('created_at', '>=', $request->start_date);
        }
        if($request->end_date) {
            $orders = $orders->where('created_at', '<=', $request->end_date);
        }
        $orders = $orders->with(['items','payments','customer'])->latest()->paginate(10);
        $total = $orders->map(function($i){
            return $i->total();
        })->sum();
        $recivedAmount = $orders->map(function($i){
            return $i->recivedAmount();
        })->sum();
        // dd($total);
        return view('orders.index',compact('orders','total','recivedAmount'));
        
    }


    public function store(OrderStoreRequest $request)
    {
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'user_id' => $request->user()->id,
        ]);

        $cart = $request->user()->cart()->get();
        foreach ($cart as $item) {
            $order->items()->create([
                'price' => $item->price * $item->pivot->quantity,
                'quantity' => $item->pivot->quantity,
                'product_id' => $item->id,
            ]);
            $item->quantity = $item->quantity - $item->pivot->quantity;
            $item->save();
        }
        $request->user()->cart()->detach();
        $order->payments()->create([
            'amount' => $request->amount,
            'user_id' => $request->user()->id,
        ]);
        return 'success';
    }
}
