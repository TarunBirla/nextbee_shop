<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    
    // 📦 PLACE ORDER
    public function store()
    {
        $items = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        if ($items->isEmpty()) {
            return redirect('/cart')->with('error', 'Cart is empty');
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => 0
        ]);

        $total = 0;

        foreach ($items as $item) {

            $total += $item->product->price * $item->quantity;

            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
            ]);
        }

        $order->update([
            'total_price' => $total
        ]);

        Cart::where('user_id', auth()->id())->delete();

        return redirect('/my-orders')->with('success', 'Order placed successfully');
    }

    public function show($id)
    {
        $order = Order::with('items.product')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('order-details', compact('order'));
    }
    public function reorder($id)
    {
        $order = Order::with('items.product')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        foreach ($order->items as $item) {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
            ]);
        }

        return redirect('/cart')->with('success', 'Items added to cart again!');
    }
    // 📋 MY ORDERS
   public function index()
{
    $orders = Order::where('user_id', auth()->id())->latest()->get();
    $categories = Category::all();
    $products = Product::all(); // 👈 ADD THIS

    return view('orders', compact('orders', 'categories', 'products'));
}

public function allOrderProducts()
{
    $items = Order::with('items.product')
        ->where('user_id', auth()->id())
        ->get()
        ->pluck('items')
        ->flatten()
        ->whereNotNull('product');

    $products = Product::all();
    $categories = Category::all(); // 👈 ADD THIS

    return view('order-products', compact('items', 'products', 'categories'));
}

public function reorderSubmit(Request $request)
{
    $products = $request->products;
    $coupon = $request->coupon;

    if (!$products || count($products) == 0) {
        return back()->with('error', 'No products selected');
    }

    $total = 0;

    // ✅ CALCULATE TOTAL
    foreach ($products as $p) {
        $product = Product::find($p['id']);

        if (!$product) continue;

        $total += $product->price * $p['qty'];
    }

    // ✅ APPLY COUPON
    $discount = 0;

    if ($coupon == 'SAVE10') {
        $discount = $total * 0.10; // 10%
    }

    if ($coupon == 'FLAT50') {
        $discount = 50; // flat
    }

    $finalTotal = $total - $discount;

    // ✅ CREATE ORDER
    $order = Order::create([
        'user_id' => auth()->id(),
        'total_price' => $finalTotal
    ]);

    foreach ($products as $p) {
        $order->items()->create([
            'product_id' => $p['id'],
            'quantity' => $p['qty'],
        ]);
    }

    return redirect('/my-orders')->with('success', 'Order placed with discount!');
}
}