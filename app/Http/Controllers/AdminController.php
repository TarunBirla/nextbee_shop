<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    // DASHBOARD
    public function dashboard()
    {
        $orders = Order::count();
        $products = Product::count();
        $users = User::where('role', 'customer')->count();

        return view('admin.dashboard', compact('orders', 'products', 'users'));
    }

    // ORDERS PAGE
    public function orders()
    {
        $orders = Order::with('user')
            ->latest()
            ->get();

        return view('admin.orders', compact('orders'));
    }

    // USERS PAGE (ONLY CUSTOMERS)
    public function users()
    {
        $users = User::where('role', 'customer')
            ->latest()
            ->get();

        return view('admin.users', compact('users'));
    }
}
