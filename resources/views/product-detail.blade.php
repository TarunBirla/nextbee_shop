@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-14">

    <div class="grid md:grid-cols-2 gap-10">

        <!-- IMAGE -->
        <div class="bg-white p-4 rounded-xl shadow flex items-center justify-center h-[420px]">
            <img src="/uploads/{{ $product->image }}"
                class="max-h-full max-w-full object-contain hover:scale-105 transition">
        </div>

        <!-- DETAILS -->
        <div>

            <h1 class="text-3xl font-bold mb-2 text-gray-800">
                {{ $product->title }}
            </h1>

            <!-- STARS (STATIC UI) -->
            <div class="flex items-center gap-2 mb-3">
                <span class="text-yellow-400">★★★★★</span>
                <span class="text-sm text-gray-500">(4.5 Rating)</span>
            </div>

            <p class="text-gray-600 mb-4 leading-relaxed">
                {{ $product->description }}
            </p>

            <!-- PRICE -->
            <div class="mb-5">
                @auth
                    <p class="text-3xl font-bold text-[#8B5E3C]">£{{ $product->price }}</p>
                @else
                    <p class="text-red-500 font-medium">
                       
                    </p>
                @endauth
            </div>

            <!-- ACTION BUTTONS -->
            <div class="flex gap-3">

                <form action="/add-to-cart/{{ $product->id }}" method="POST" class="w-full">
                    @csrf
                    <button
                        class="w-full bg-[#8B5E3C] hover:bg-[#8B5E3C] text-white py-3 rounded-lg font-medium">
                        Add to Cart
                    </button>
                </form>

                

            </div>

            <!-- EXTRA INFO -->
            <div class="mt-6 text-sm text-gray-500 space-y-1">
                <p>✔ Free delivery available</p>
                <p>✔ Cash on delivery supported</p>
                <p>✔ 7 days return policy</p>
            </div>

        </div>

    </div>

    <!-- ================= RELATED PRODUCTS ================= -->
    <div class="mt-16">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-[#8B5E3C]">Related Products</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">


           @foreach($relatedProducts as $rel)


                         <div
                    class="bg-white border rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition duration-300 flex flex-col">

                    <!-- IMAGE -->
                    <div class="h-48 w-full overflow-hidden  flex items-center justify-center">
                        <img src="/uploads/{{ $rel->image }}"
                            class="max-h-full max-w-full object-contain hover:scale-105 transition duration-300">
                    </div>

                    <!-- CONTENT -->
                    <div class="p-4 flex flex-col flex-1">

                        <!-- TITLE -->
                        <h3 class="font-semibold text-lg text-gray-800 line-clamp-1">
                            {{ $rel->title }}
                        </h3>

                        <!-- DESCRIPTION -->
                        <p class="text-gray-500 text-sm mt-1 mb-3 line-clamp-2">
                            {{ \Illuminate\Support\Str::limit($rel->description, 80) }}
                        </p>

                        <!-- PRICE -->
                        <div class="mb-4">
                            @auth
                                <p class="text-[#8B5E3C] font-bold text-lg">£{{ $rel->price }}</p>
                            @else
                                <p class="text-red-500 font-medium text-sm"></p>
                            @endauth
                        </div>

                        <!-- BUTTONS -->
                        <div class="mt-auto flex gap-2">

                            <!-- VIEW -->
                            <a href="/product/{{ $rel->id }}"
                                class="flex-1 text-center bg-[#8B5E3C] hover:bg-[#8B5E3C] text-white py-2 rounded-lg text-sm font-medium">
                                View
                            </a>

                            <!-- ADD TO CART -->
                            <form action="/add-to-cart/{{ $rel->id }}" method="POST" class="flex-1">
                                @csrf
                                <button
                                    class="w-full bg-gray-600 hover:bg-gray-700 text-white py-2 rounded-lg text-sm font-medium">
                                    + Add to Cart
                                </button>
                            </form>

                        </div>

                    </div>

                </div>

                  
            @endforeach

        </div>

    </div>

</div>

@endsection