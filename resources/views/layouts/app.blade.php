<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eurowide</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-gray-800">
    <div class="bg-white shadow-md  sticky top-0 z-50">
        <header class="bg-white shadow-md border-b">
            <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">

                <!-- Logo -->
                <a href="/" class="text-2xl font-bold text-[#253375] flex items-center gap-2">
                    <i class="fa-solid fa-globe"></i>
                    Eurowide
                </a>
                <button class="md:hidden text-2xl text-[#253375]" onclick="toggleMobileMenu()">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <!-- Search -->
                <div class="flex-1 mx-6 hidden md:block relative">
                    <input type="text" placeholder="Search products..."
                        class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#253375] focus:outline-none">

                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400"></i>
                </div>

                <!-- Right Side -->
                <div class="hidden md:flex items-center gap-3">

                    @auth
                        <!-- Dropdown -->
                        <div class="relative">

                            <!-- Button -->
                            <button id="userBtn" onclick="toggleUserDropdown(event)"
                                class="bg-[#253375] text-white px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-[#1d2a5c]">
                                <i class="fa-solid fa-user"></i>
                                {{ auth()->user()->name }}
                                <i class="fa-solid fa-chevron-down text-sm"></i>
                            </button>

                            <!-- Dropdown -->
                            <div id="userDropdown"
                                class="absolute right-0 mt-2 w-52 bg-white rounded-lg shadow-lg hidden group-hover:block z-50">

                                <a href="/profile" class="block px-4 py-2 hover:bg-gray-100">
                                    <i class="fa-solid fa-user mr-2"></i> My Profile
                                </a>

                                <a href="/cart" class="block px-4 py-2 hover:bg-gray-100">
                                    <i class="fa-solid fa-cart-shopping mr-2"></i> My Cart
                                </a>

                                <a href="/my-orders" class="block px-4 py-2 hover:bg-gray-100">
                                    <i class="fa-solid fa-box mr-2"></i> My Orders
                                </a>

                                <a href="/dashboard" class="block px-4 py-2 hover:bg-gray-100">
                                    <i class="fa-solid fa-chart-line mr-2"></i> Dashboard
                                </a>

                                <form action="/logout" method="POST">
                                    @csrf
                                    <button class="w-full text-left px-4 py-2 hover:bg-red-100 text-red-600">
                                        <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
                                    </button>
                                </form>

                            </div>
                        </div>
                    @else
                        <a href="/login" class="bg-[#253375] text-white px-4 py-2 rounded-lg flex items-center gap-2">
                            <i class="fa-solid fa-right-to-bracket"></i> Login
                        </a>
                    @endauth

                    <a href="#" class="bg-[#253375] text-white px-4 py-2 rounded-lg flex items-center gap-2">
                        <i class="fa-solid fa-phone"></i> Call Now
                    </a>

                    <a href="#" class="bg-[#253375] text-white px-4 py-2 rounded-lg flex items-center gap-2">
                        <i class="fa-solid fa-envelope"></i> Contact
                    </a>

                </div>
            </div>
        </header>
        <!-- NAVBAR -->
        <div class="bg-[#253375] hidden md:flex">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-center items-center gap-10 py-3 text-white font-medium uppercase">

                    <a href="/" class="hover:text-gray-200">Home</a>

                    <a href="#" class="hover:text-gray-200">Products</a>

                    <a href="#" class="hover:text-gray-200">About Us</a>

                    <!-- Categories Dropdown -->
                    <!-- Categories Dropdown -->
                    <div class="relative">

                        <!-- Button -->
                        <button id="categoryBtn" onclick="toggleCategoryDropdown(event)"
                            class="hover:text-gray-200 uppercase flex items-center gap-1">
                            Categories
                            <i class="fa-solid fa-chevron-down text-sm"></i>
                        </button>

                        <!-- Dropdown -->
                        <div id="categoryDropdown"
                            class="absolute left-1/2 transform -translate-x-1/2 hidden bg-white text-black mt-3 rounded-lg shadow-lg w-52 z-50">

                            @foreach($categories as $cat)
                                <a href="/category/{{ $cat->id }}"
                                    class="block px-4 py-2 hover:bg-gray-100  last:border-none">
                                    {{ $cat->name }}
                                </a>
                            @endforeach

                        </div>

                    </div>
                    <a href="#" class="hover:text-gray-200">Contact</a>

                </div>
            </div>
        </div>
    </div>

    <!-- MOBILE MENU -->
    <!-- MOBILE MENU -->
    <div id="mobileMenu" class="md:hidden hidden bg-white border-t shadow-lg">

        <!-- USER SECTION -->
        <div class="p-4 border-b flex flex-col gap-3">

            @auth
                <!-- User Dropdown Wrapper -->
                <div class="relative">

                    <!-- Button -->
                    <button onclick="toggleUserDropdown(event)"
                        class="w-full bg-[#253375] text-white px-4 py-2 rounded-lg flex items-center justify-between">

                        <span>
                            <i class="fa-solid fa-user mr-2"></i>
                            {{ auth()->user()->name }}
                        </span>

                        <i class="fa-solid fa-chevron-down text-sm"></i>
                    </button>

                    <!-- Dropdown -->
                    <div id="userDropdown" class="hidden mt-2 w-full bg-white rounded-lg shadow border">

                        <a href="/profile" class="block px-4 py-2 hover:bg-gray-100">
                            <i class="fa-solid fa-user mr-2"></i> My Profile
                        </a>

                        <a href="/cart" class="block px-4 py-2 hover:bg-gray-100">
                            <i class="fa-solid fa-cart-shopping mr-2"></i> My Cart
                        </a>

                        <a href="/my-orders" class="block px-4 py-2 hover:bg-gray-100">
                            <i class="fa-solid fa-box mr-2"></i> My Orders
                        </a>

                        <a href="/dashboard" class="block px-4 py-2 hover:bg-gray-100">
                            <i class="fa-solid fa-chart-line mr-2"></i> Dashboard
                        </a>

                        <form action="/logout" method="POST">
                            @csrf
                            <button class="w-full text-left px-4 py-2 hover:bg-red-100 text-red-600">
                                <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
                            </button>
                        </form>

                    </div>
                </div>
            @else
                <a href="/login"
                    class="bg-[#253375] text-white px-4 py-2 rounded-lg flex items-center gap-2 justify-center">
                    <i class="fa-solid fa-right-to-bracket"></i> Login
                </a>
            @endauth

            <a href="#" class="bg-[#253375] text-white px-4 py-2 rounded-lg flex items-center gap-2 justify-center">
                <i class="fa-solid fa-phone"></i> Call Now
            </a>

            <a href="#" class="bg-[#253375] text-white px-4 py-2 rounded-lg flex items-center gap-2 justify-center">
                <i class="fa-solid fa-envelope"></i> Contact
            </a>

        </div>

        <!-- NAV LINKS -->
        <a href="/" class="block px-4 py-3 border-b hover:bg-gray-50">Home</a>
        <a href="#" class="block px-4 py-3 border-b hover:bg-gray-50">Products</a>
        <a href="#" class="block px-4 py-3 border-b hover:bg-gray-50">About Us</a>

        <!-- CATEGORIES -->
        <button onclick="toggleMobileCategories()"
            class="w-full text-left px-4 py-3 border-b hover:bg-gray-50 flex justify-between items-center">
            Categories
            <i class="fa-solid fa-chevron-down text-sm"></i>
        </button>

        <div id="mobileCategories" class="hidden pl-6 bg-gray-50">
            @foreach($categories as $cat)
                <a href="/category/{{ $cat->id }}" class="block py-2 border-b text-sm hover:bg-white">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>

        <a href="/contact" class="block px-4 py-3 hover:bg-gray-50">Contact</a>

    </div>
    <!-- CONTENT -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-[#253375] text-white mt-10">
        <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-4 gap-6">

            <div>
                <h3 class="text-lg font-semibold mb-3">About Us</h3>
                <p class="text-sm">Wholesale products worldwide.</p>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-3">Quick Links</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="/">Home</a></li>
                    <li><a href="#">Products</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-3">Contact</h3>
                <p class="text-sm">info@eurowide.com</p>
                <p class="text-sm">+91 9999999999</p>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-3">Subscribe</h3>
                <input type="email" placeholder="Your email" class="w-full px-3 py-2 rounded-lg text-black mb-2">
                <button class="bg-white text-blue-600 px-4 py-2 rounded-lg w-full">
                    Subscribe
                </button>
            </div>
        </div>

        <div class="text-center py-4 border-t border-blue-500 text-sm">
            © 2026 Eurowide. All rights reserved.
        </div>
    </footer>

    <script>
        function toggleCategoryDropdown(event) {
            event.stopPropagation();

            const dropdown = document.getElementById("categoryDropdown");
            const userDropdown = document.getElementById("userDropdown");

            dropdown.classList.toggle("hidden");

            // Close user dropdown if open
            if (userDropdown) userDropdown.classList.add("hidden");
        }


        function toggleUserDropdown(event) {
            event.stopPropagation();

            const dropdown = document.getElementById("userDropdown");
            const categoryDropdown = document.getElementById("categoryDropdown");

            // toggle user dropdown
            dropdown.classList.toggle("hidden");

            // close category dropdown if open
            if (categoryDropdown) {
                categoryDropdown.classList.add("hidden");
            }
        }

        function toggleCategoryDropdown(event) {
            event.stopPropagation();

            const dropdown = document.getElementById("categoryDropdown");
            const userDropdown = document.getElementById("userDropdown");

            dropdown.classList.toggle("hidden");

            if (userDropdown) {
                userDropdown.classList.add("hidden");
            }
        }

        // outside click close (SINGLE CLEAN HANDLER)
        document.addEventListener("click", function () {
            document.getElementById("userDropdown")?.classList.add("hidden");
            document.getElementById("categoryDropdown")?.classList.add("hidden");
        });


        // Close when clicking outside
        document.addEventListener("click", function (event) {
            const categoryDropdown = document.getElementById("categoryDropdown");
            const userDropdown = document.getElementById("userDropdown");

            if (!event.target.closest("#categoryBtn") && !event.target.closest("#categoryDropdown")) {
                if (categoryDropdown) categoryDropdown.classList.add("hidden");
            }

            if (!event.target.closest("#userDropdown") && !event.target.closest("button")) {
                if (userDropdown) userDropdown.classList.add("hidden");
            }
        });
    </script>
    <script>
    function toggleUserDropdown(event) {
        event.stopPropagation();
        document.getElementById("userDropdown").classList.toggle("hidden");
    }

    function toggleMobileCategories() {
        document.getElementById("mobileCategories").classList.toggle("hidden");
    }

    // close dropdown when click outside
    document.addEventListener("click", function () {
        document.getElementById("userDropdown")?.classList.add("hidden");
    });
</script>

</body>

</html>