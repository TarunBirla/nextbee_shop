@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-14">

<h2 class="text-2xl font-bold mb-6">All Products</h2>

<div class="grid grid-cols-4 gap-6">

@foreach($products as $p)
<div class="border p-4 rounded">

    <img src="/uploads/{{ $p->image }}" class="h-40 w-full object-cover">

    <h3>{{ $p->title }}</h3>
                            {{ \Illuminate\Support\Str::limit($p->description, 50) }}


   @auth
    <p class="text-blue-600 font-bold mb-3">£{{ $p->price }}</p>
@else
    <p class="text-red-500 font-medium mb-3">
        Login to see price
    </p>
@endauth

    <a href="/product/{{ $p->id }}" 
       class="block bg-black text-white text-center mt-2">
        View
    </a>

    <!-- ✅ ADD TO CART -->
    <form action="/add-to-cart/{{ $p->id }}" method="POST">
        @csrf
        <button class="w-full mt-2 bg-[#253375] text-white py-2 rounded">
            Add to Cart
        </button>
    </form>

</div>
@endforeach

</div>

</div>

@endsection