<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Category;

class OrderController extends Controller
{
    // 📦 PLACE ORDER
    public function store()
    {
        $items = Cart::where('user_id', auth()->id())
                    ->with('product')
                    ->get();

        $total = 0;

        foreach ($items as $item) {
            $total += $item->product->price * $item->quantity;
        }

        Order::create([
            'user_id' => auth()->id(),
            'total_price' => $total
        ]);

        // 🧹 CLEAR CART
        Cart::where('user_id', auth()->id())->delete();

        // 🔥 REDIRECT TO MY ORDERS
        return redirect('/my-orders')->with('success','Order placed successfully');
    }

    // 📋 MY ORDERS
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->latest()->get();
        $categories = Category::all();

        return view('orders', compact('orders','categories'));
    }
}