<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    // DASHBOARD
    public function dashboard()
    {
        $user = auth()->user();

        $data = [
            'orders' => 0,
            'products' => 0,
            'users' => 0,
            'totalEarning' => 0,
            'role' => $user->role
        ];

        // BUSINESS OWNER (FULL ACCESS 360°)
        if ($user->role == 'business_owner') {

            $data['orders'] = Order::count();
            $data['products'] = Product::count();
            $data['users'] = User::where('role', 'customer')->count();
            $data['totalEarning'] = Order::where('status', 'completed')->sum('total_price');
        }

        // SALES REP
        elseif ($user->role == 'sale_rep') {

            $data['orders'] = Order::whereIn('status', ['pending', 'confirmed', 'processing'])->count();
            $data['totalEarning'] = Order::where('status', 'completed')->sum('total_price');
        }

        // INVENTORY MANAGER
        elseif ($user->role == 'inventory_manager') {

            $data['products'] = Product::count();
        }

        // DELIVERY TEAM
        elseif ($user->role == 'delivery_team') {

            $data['orders'] = Order::whereIn('status', ['shipped', 'out_for_delivery'])->count();
        }

        return view('admin.dashboard', $data);
    }

    // ORDERS PAGE
    public function orders()
    {
        $orders = Order::with('user')->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    // UPDATE ORDER STATUS
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Order status updated successfully');
    }
    public function orderView($id)
    {
        $order = Order::with('user')->findOrFail($id);

        return view('admin.order_view', compact('order'));
    }
    // DELETE ORDER
    public function destroyOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return back()->with('success', 'Order deleted successfully');
    }

    // USERS PAGE
    // USERS LIST
    public function users()
    {
        $users = User::where('role', '!=', 'business_owner')
            ->latest()
            ->get();

        return view('admin.users', compact('users'));
    }

    // CREATE PAGE
    public function createUser()
    {
        $roles = [
            'sale_rep',
            'inventory_manager',
            'delivery_team',
            'customer'
        ];

        return view('admin.users_create', compact('roles'));
    }

    // STORE USER
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect('/admin/users')->with('success', 'User created successfully');
    }

    // DELETE USER
    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'User deleted successfully');
    }
}