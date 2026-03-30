@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">

    <h2 class="text-2xl font-bold mb-6">Products</h2>

    <div class="grid grid-cols-4 gap-6">

        @foreach($products as $p)
        <div class="border p-4 rounded shadow">

            <img src="/uploads/{{ $p->image }}" class="h-40 w-full object-cover">

            <h3 class="font-bold mt-2">{{ $p->title }}</h3>

            <p class="text-blue-600 font-bold">£{{ $p->price }}</p>

            <a href="/product/{{ $p->id }}" 
               class="block mt-2 bg-gray-800 text-white text-center py-1 rounded">
                View
            </a>

            <form action="/add-to-cart/{{ $p->id }}" method="POST">
                @csrf
                <button class="w-full mt-2 bg-[#253375] text-white py-1 rounded">
                    Add to Cart
                </button>
            </form>

        </div>
        @endforeach

    </div>

</div>

@endsection