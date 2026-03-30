<?php
// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }
    public function search(Request $request)
    {
        $query = $request->q;

        if (!$query) {
            return response()->json([]);
        }

        $products = Product::where('title', 'like', "%{$query}%")
            ->orWhere('name', 'like', "%{$query}%")
            ->select('id', 'title', 'price', 'image')
            ->limit(8)
            ->get();

        return response()->json($products);
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ]);

        $data = $request->only(['title', 'description', 'price', 'category_id']);

        // IMAGE
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $name);
            $data['image'] = $name;
        }

        Product::create($data);

        return redirect('/admin/products')->with('success', 'Product added');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $name);
            $data['image'] = $name;
        }

        $product->update($data);

        return redirect('/admin/products');
    }

    public function destroy($id)
    {
        Product::find($id)->delete();
        return back();
    }
}