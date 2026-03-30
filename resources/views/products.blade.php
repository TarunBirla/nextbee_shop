@extends('layouts.app')

@section('content')

    <div class="max-w-7xl mx-auto px-6 py-14">

        <h2 class="text-2xl font-bold mb-6">All Products</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @foreach($products as $p)
                <div
                    class="bg-white border rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition duration-300 flex flex-col">

                    <!-- IMAGE -->
                    <div class="h-48 w-full overflow-hidden  flex items-center justify-center">
                        <img src="/uploads/{{ $p->image }}"
                            class="max-h-full max-w-full object-contain hover:scale-105 transition duration-300">
                    </div>

                    <!-- CONTENT -->
                    <div class="p-4 flex flex-col flex-1">

                        <!-- TITLE -->
                        <h3 class="font-semibold text-lg text-gray-800 line-clamp-1">
                            {{ $p->title }}
                        </h3>

                        <!-- DESCRIPTION -->
                        <p class="text-gray-500 text-sm mt-1 mb-3 line-clamp-2">
                            {{ \Illuminate\Support\Str::limit($p->description, 80) }}
                        </p>

                        <!-- PRICE -->
                        <div class="mb-4">
                            @auth
                                <p class="text-[#8B5E3C] font-bold text-lg">£{{ $p->price }}</p>
                            @else
                                <p class="text-red-500 font-medium text-sm"></p>
                            @endauth
                        </div>

                        <!-- BUTTONS -->
                        <div class="mt-auto flex gap-2">

                            <!-- VIEW -->
                            <a href="/product/{{ $p->id }}"
                                class="flex-1 text-center bg-[#8B5E3C] hover:bg-[#8B5E3C] text-white py-2 rounded-lg text-sm font-medium">
                                View
                            </a>

                            <!-- ADD TO CART -->
                            <form action="/add-to-cart/{{ $p->id }}" method="POST" class="flex-1">
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

@endsection