<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;

class CartController extends Controller
{
    // ➕ ADD TO CART
  public function add($id)
{
    $existing = Cart::where('user_id', auth()->id())
        ->where('product_id', $id)
        ->first();

    if ($existing) {
        $existing->quantity += 1;
        $existing->save();
    } else {
        Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $id,
            'quantity' => 1
        ]);
    }

   return redirect('/cart')->with('success','Added to cart');
}

    // 🛒 CART PAGE
    public function index()
    {
        $items = Cart::where('user_id', auth()->id())
                    ->with('product')
                    ->get();

        $categories = Category::all();

        return view('cart', compact('items','categories'));
    }
    public function remove($id)
{
    Cart::where('id', $id)
        ->where('user_id', auth()->id())
        ->delete();

    return back()->with('success', 'Item removed');
}
}