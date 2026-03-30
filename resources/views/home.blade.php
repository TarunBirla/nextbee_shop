@extends('layouts.app')

@section('content')

    <div>

        <!-- HERO SLIDER -->
        <div class="relative w-full h-[400px] overflow-hidden">

            <!-- Slide 1 -->
            <div class="slide absolute inset-0 bg-cover bg-center flex items-center justify-center text-center text-white"
                style="background-image: url('/chips.jpg');">

            </div>

            <!-- Slide 2 -->
            <div class="slide absolute inset-0 bg-cover bg-center flex items-center justify-center text-center text-white hidden"
                style="background-image: url('/drinks.jpg');">

            </div>

        </div>

        <!-- FEATURES STRIP -->
        <div class="bg-[#8B5E3C] text-white py-8">
            <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">

                <!-- Item 1 -->
                <div class="flex flex-col items-center gap-2">
                    <div class="text-3xl">
                        <i class="fa-solid fa-truck-fast"></i>
                    </div>
                    <h3 class="font-semibold">Nationwide Delivery</h3>
                </div>

                <!-- Item 2 -->
                <div class="flex flex-col items-center gap-2">
                    <div class="text-3xl">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <h3 class="font-semibold">100% Satisfaction Guaranteed</h3>
                </div>

                <!-- Item 3 -->
                <div class="flex flex-col items-center gap-2">
                    <div class="text-3xl">
                        <i class="fa-solid fa-tags"></i>
                    </div>
                    <h3 class="font-semibold">Exclusive Deals & Bulk Pricing</h3>
                </div>

                <!-- Item 4 -->
                <div class="flex flex-col items-center gap-2">
                    <div class="text-3xl">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <h3 class="font-semibold">Customer Support</h3>
                </div>

            </div>
        </div>

        <!-- ABOUT SECTION -->
        <div class="max-w-7xl mx-auto px-6 py-14">

            <div class="grid md:grid-cols-2 gap-10 items-center">

                <!-- LEFT CONTENT -->
                <div>
                    <h2 class="text-3xl font-bold text-[#8B5E3C] mb-4">
                        About Us
                    </h2>

                    <p class="text-gray-600 mb-6">
                        Eurowide Cash & Carry is your reliable wholesale and direct delivery partner, supplying FMCG
                        products across the UK and internationally. With competitive pricing, fast service, and bulk supply,
                        we cater to retailers, restaurants, and caterers, ensuring seamless nationwide and export delivery
                        for your business needs.
                    </p>

                    <!-- CARDS -->
                    <div class="grid grid-cols-2 gap-4 mt-6">

                        <!-- Wholesalers -->
                        <div class="p-4 border rounded-lg text-center hover:bg-[#8B5E3C] hover:text-white transition">
                            <div class="text-2xl mb-2">
                                <i class="fa-solid fa-building"></i>
                            </div>
                            <p class="font-semibold">Wholesalers</p>
                        </div>

                        <!-- Retailers -->
                        <div class="p-4 border rounded-lg text-center hover:bg-[#8B5E3C] hover:text-white transition">
                            <div class="text-2xl mb-2">
                                <i class="fa-solid fa-store"></i>
                            </div>
                            <p class="font-semibold">Retailers</p>
                        </div>

                        <!-- Distributors -->
                        <div class="p-4 border rounded-lg text-center hover:bg-[#8B5E3C] hover:text-white transition">
                            <div class="text-2xl mb-2">
                                <i class="fa-solid fa-truck"></i>
                            </div>
                            <p class="font-semibold">Distributors</p>
                        </div>

                        <!-- Trade Agent -->
                        <div class="p-4 border rounded-lg text-center hover:bg-[#8B5E3C] hover:text-white transition">
                            <div class="text-2xl mb-2">
                                <i class="fa-solid fa-handshake"></i>
                            </div>
                            <p class="font-semibold">Trade Agent</p>
                        </div>

                    </div>
                </div>

                <!-- RIGHT IMAGE -->
                <div>
                    <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d" alt="About Eurowide"
                        class="rounded-xl shadow-lg w-full">
                </div>

            </div>

        </div>

        <!-- CATEGORIES SECTION -->
        <div class="bg-gray-50 py-14">
            <div class="max-w-7xl mx-auto px-6">

                <!-- Heading -->
                <h2 class="text-3xl font-bold text-[#8B5E3C] mb-8 text-center">
                    Our Categories
                </h2>

                <!-- Categories Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">

                    @foreach($categories as $cat)
                        <a href="/category/{{ $cat->id }}"
                            class="bg-[#8B5E3C] text-white rounded-xl shadow hover:shadow-lg overflow-hidden group transition">



                            <div class="p-4 flex items-center justify-between hover:bg-[#fff] hover:text-[#8B5E3C]">
                                <h3 class="font-semibold">{{ $cat->name }}</h3>
                                <span>→</span>
                            </div>
                        </a>
                    @endforeach

                </div>

            </div>
        </div>


        <!-- PRODUCTS SECTION -->
       <div class="max-w-7xl mx-auto px-6 py-14">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-[#8B5E3C]">Featured Products</h2>
        <a href="/products" class="text-black font-medium hover:underline">View All →</a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @foreach($products as $p)
        <div class="bg-white border rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition duration-300 flex flex-col">

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

    </div>

    <script>
        let slides = document.querySelectorAll('.slide');
        let index = 0;

        setInterval(() => {
            slides[index].classList.add('hidden');
            index = (index + 1) % slides.length;
            slides[index].classList.remove('hidden');
        }, 3000);
    </script>
@endsection