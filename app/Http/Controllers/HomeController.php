<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    // 🏠 HOME PAGE
 public function index()
{
    $products = Product::latest()->take(6)->get(); // ✅ latest 6
    $categories = Category::all();

    return view('home', compact('products', 'categories'));
}

    // 📂 CATEGORY WISE PRODUCTS
    public function categoryProducts($id)
    {
        $products = Product::where('category_id', $id)->get();
        $categories = Category::all();

        return view('category-products', compact('products', 'categories'));
    }

    // 📦 PRODUCT DETAIL
    public function productDetail($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('product-detail', compact('product', 'categories'));
    }
    public function allProduct()
    {
        $products = Product::all();

        return view('products', compact('products')); // ✅ products
    }
}