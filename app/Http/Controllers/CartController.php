<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
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
public function addMultiple(Request $request)
{
    $products = $request->products;

    if (!$products) {
        return back()->with('error', 'No product selected');
    }

    foreach ($products as $item) {

        $existing = Cart::where('user_id', auth()->id())
            ->where('product_id', $item['id'])
            ->first();

        if ($existing) {
            $existing->quantity += $item['qty'];
            $existing->save();
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $item['id'],
                'quantity' => $item['qty']
            ]);
        }
    }

    return redirect('/cart')->with('success', 'Products added to cart!');
}

// ➕ INCREASE QTY
public function increase($id)
{
    $item = Cart::where('id', $id)
        ->where('user_id', auth()->id())
        ->first();

    if ($item) {
        $item->quantity += 1;
        $item->save();
    }

    return back();
}

// ➖ DECREASE QTY
public function decrease($id)
{
    $item = Cart::where('id', $id)
        ->where('user_id', auth()->id())
        ->first();

    if ($item) {

        if ($item->quantity > 1) {
            $item->quantity -= 1;
            $item->save();
        } else {
            $item->delete(); // qty 1 hai to remove
        }
    }

    return back();
}
public function updateQty(Request $request, $id)
{
    $item = Cart::where('id', $id)
        ->where('user_id', auth()->id())
        ->first();

    if ($item) {

        $qty = (int) $request->qty;

        if ($qty <= 0) {
            $item->delete(); // remove if 0
        } else {
            $item->quantity = $qty;
            $item->save();
        }
    }

    return back();
}
}