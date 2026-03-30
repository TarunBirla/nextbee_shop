@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-14">

    <div class="grid md:grid-cols-2 gap-10">

        <div>
            <img src="/uploads/{{ $product->image }}" class="rounded-xl shadow">
        </div>

        <div>
            <h1 class="text-3xl font-bold mb-3">
                {{ $product->title }}
            </h1>

            <p class="text-gray-600 mb-4">
                {{ $product->description }}
            </p>

            @auth
    <p class="text-blue-600 font-bold mb-3">£{{ $product->price }}</p>
@else
    <p class="text-red-500 font-medium mb-3">
        Login to see price
    </p>
@endauth

            <!-- ✅ ADD TO CART -->
            <form action="/add-to-cart/{{ $product->id }}" method="POST">
                @csrf
                <button class="bg-[#253375] text-white px-6 py-2 rounded-lg">
                    Add to Cart
                </button>
            </form>

        </div>

    </div>

</div>

@endsection