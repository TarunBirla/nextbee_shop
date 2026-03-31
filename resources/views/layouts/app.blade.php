<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eurowide | Premium Wholesale</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --sky: #0ea5e9;
            --sky-light: #e0f2fe;
            --sky-mid: #38bdf8;
            --sky-dark: #0369a1;
            --sky-deep: #075985;
            --white: #ffffff;
            --gray-soft: #f0f9ff;
            --text-dark: #0c2340;
            --text-mid: #374151;
            --accent: #f59e0b;
            --accent-light: #fef3c7;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--white);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        h1, h2, h3, .logo-font { font-family: 'Playfair Display', serif; }

        /* TOP BAR */
        .top-bar {
            background: var(--sky-deep);
            color: #bae6fd;
            font-size: 0.78rem;
            padding: 6px 0;
            letter-spacing: 0.03em;
        }

        /* HEADER */
        .main-header {
            background: var(--white);
            border-bottom: 1px solid #e0f2fe;
            padding: 14px 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 20px rgba(14, 165, 233, 0.08);
            backdrop-filter: blur(10px);
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.7rem;
            font-weight: 800;
            color: var(--sky-dark);
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            letter-spacing: -0.02em;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--sky), var(--sky-dark));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
        }

        /* SEARCH */
        .search-wrap {
            position: relative;
            flex: 1;
            max-width: 480px;
        }

        .search-input {
            width: 100%;
            padding: 11px 18px 11px 44px;
            border: 2px solid #e0f2fe;
            border-radius: 50px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            background: var(--gray-soft);
            color: var(--text-dark);
            transition: all 0.3s ease;
            outline: none;
        }

        .search-input:focus {
            border-color: var(--sky-mid);
            background: white;
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--sky);
            font-size: 0.95rem;
        }

        .search-results-drop {
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            right: 0;
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.12);
            border: 1px solid #e0f2fe;
            max-height: 320px;
            overflow-y: auto;
            z-index: 200;
            display: none;
        }

        /* HEADER BUTTONS */
        .hdr-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 18px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.25s ease;
            text-decoration: none;
            border: none;
            white-space: nowrap;
        }

        .hdr-btn-primary {
            background: linear-gradient(135deg, var(--sky), var(--sky-dark));
            color: white;
            box-shadow: 0 4px 14px rgba(14, 165, 233, 0.3);
        }

        .hdr-btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(14, 165, 233, 0.4);
        }

        .hdr-btn-outline {
            background: transparent;
            color: var(--sky-dark);
            border: 2px solid #bae6fd;
        }

        .hdr-btn-outline:hover {
            background: var(--sky-light);
            border-color: var(--sky);
        }

        /* USER DROPDOWN */
        .dropdown-menu {
            position: absolute;
            right: 0;
            top: calc(100% + 10px);
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.12);
            border: 1px solid #e0f2fe;
            min-width: 200px;
            overflow: hidden;
            display: none;
            z-index: 200;
        }

        .dropdown-menu a, .dropdown-menu button {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 16px;
            font-size: 0.88rem;
            color: var(--text-dark);
            text-decoration: none;
            transition: background 0.2s;
            width: 100%;
            text-align: left;
            border: none;
            background: transparent;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
        }

        .dropdown-menu a:hover { background: var(--sky-light); color: var(--sky-dark); }
        .dropdown-menu .logout-btn:hover { background: #fef2f2; color: #dc2626; }

        .dropdown-menu .dropdown-divider {
            height: 1px;
            background: #f0f9ff;
            margin: 4px 0;
        }

        /* NAVBAR */
        .main-nav {
            background: linear-gradient(90deg, var(--sky-dark) 0%, var(--sky) 100%);
        }

        .nav-link {
            color: rgba(255,255,255,0.85);
            font-size: 0.88rem;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 14px 4px;
            text-decoration: none;
            position: relative;
            transition: color 0.25s;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: white;
            transform: scaleX(0);
            transition: transform 0.25s;
            border-radius: 2px;
        }

        .nav-link:hover { color: white; }
        .nav-link:hover::after { transform: scaleX(1); }

        /* CAT DROPDOWN */
        .cat-dropdown {
            position: absolute;
            top: calc(100% + 4px);
            left: 50%;
            transform: translateX(-50%);
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.14);
            min-width: 200px;
            overflow: hidden;
            display: none;
            z-index: 200;
        }

        .cat-dropdown a {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            font-size: 0.88rem;
            color: var(--text-dark);
            text-decoration: none;
            transition: all 0.2s;
            border-bottom: 1px solid #f0f9ff;
        }

        .cat-dropdown a:last-child { border-bottom: none; }
        .cat-dropdown a:hover { background: var(--sky-light); color: var(--sky-dark); padding-left: 22px; }

        /* MOBILE MENU */
        .mobile-menu {
            background: white;
            border-top: 2px solid var(--sky-light);
            display: none;
        }

        .mobile-nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            color: var(--text-dark);
            text-decoration: none;
            border-bottom: 1px solid #f0f9ff;
            font-weight: 500;
            transition: all 0.2s;
        }

        .mobile-nav-link:hover { background: var(--sky-light); color: var(--sky-dark); }

        /* FOOTER */
        .main-footer {
            background: linear-gradient(135deg, var(--sky-deep) 0%, var(--sky-dark) 100%);
            color: rgba(255,255,255,0.85);
        }

        .footer-link { color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.88rem; transition: color 0.2s; display: block; margin-bottom: 8px; }
        .footer-link:hover { color: white; }

        .footer-newsletter input {
            width: 100%;
            padding: 11px 16px;
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.2);
            background: rgba(255,255,255,0.1);
            color: white;
            font-family: 'DM Sans', sans-serif;
            margin-bottom: 10px;
            outline: none;
        }

        .footer-newsletter input::placeholder { color: rgba(255,255,255,0.5); }
        .footer-newsletter input:focus { border-color: var(--sky-mid); background: rgba(255,255,255,0.15); }

        .footer-newsletter button {
            width: 100%;
            padding: 11px;
            background: white;
            color: var(--sky-dark);
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            transition: all 0.25s;
        }

        .footer-newsletter button:hover { background: var(--sky-light); transform: translateY(-1px); }

        .badge-count {
            background: var(--accent);
            color: white;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 1px 6px;
            border-radius: 20px;
            margin-left: 4px;
        }

        /* SHOW */
        .show { display: block !important; }

        @media (max-width: 768px) {
            .mobile-menu { display: none; }
            .mobile-menu.show { display: block; }
        }
    </style>
</head>

<body>

    <!-- TOP BAR -->
    <div class="top-bar">
        <div style="max-width:1280px; margin:0 auto; padding:0 24px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:6px;">
            <span><i class="fa-solid fa-location-dot" style="margin-right:6px; color:#7dd3fc;"></i> UK & International Wholesale Delivery</span>
            <span>
                <i class="fa-solid fa-phone" style="margin-right:6px; color:#7dd3fc;"></i> +44 7000 000000
                &nbsp;&nbsp;
                <i class="fa-solid fa-envelope" style="margin-right:6px; color:#7dd3fc;"></i> info@eurowide.com
            </span>
        </div>
    </div>

    <!-- HEADER -->
    <header class="main-header">
        <div style="max-width:1280px; margin:0 auto; padding:0 24px; display:flex; align-items:center; gap:20px;">

            <!-- Logo -->
            <a href="/" class="logo" style="flex-shrink:0;">
                <div class="logo-icon"><i class="fa-solid fa-globe"></i></div>
                Eurowide
            </a>

            <!-- Search -->
            <div class="search-wrap" style="flex:1; margin:0 20px;">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                <input type="text" id="searchInput" class="search-input" placeholder="Search products, brands, categories..." onkeyup="searchProducts(this.value)">
                <div id="searchResults" class="search-results-drop"></div>
            </div>

            <!-- Right actions -->
            <div style="display:flex; align-items:center; gap:10px; flex-shrink:0;" class="hdr-right">
                @auth
                    <!-- Cart -->
                    <a href="/cart" class="hdr-btn hdr-btn-outline" style="position:relative;">
                        <i class="fa-solid fa-cart-shopping"></i>
                        Cart
                    </a>

                    <!-- User Dropdown -->
                    <div style="position:relative;">
                        <button class="hdr-btn hdr-btn-primary" onclick="toggleDropdown('userDrop', event)">
                            <i class="fa-solid fa-circle-user"></i>
                            {{ auth()->user()->name }}
                            <i class="fa-solid fa-chevron-down" style="font-size:0.7rem;"></i>
                        </button>
                        <div id="userDrop" class="dropdown-menu">
                            <a href="/profile"><i class="fa-solid fa-user" style="color:var(--sky);"></i> My Profile</a>
                            <a href="/cart"><i class="fa-solid fa-cart-shopping" style="color:var(--sky);"></i> My Cart</a>
                            <a href="/my-orders"><i class="fa-solid fa-box" style="color:var(--sky);"></i> My Orders</a>
                            <div class="dropdown-divider"></div>
                            <form action="/logout" method="POST">
                                @csrf
                                <button class="logout-btn"><i class="fa-solid fa-right-from-bracket" style="color:#dc2626;"></i> Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="/login" class="hdr-btn hdr-btn-outline">
                        <i class="fa-solid fa-right-to-bracket"></i> Login
                    </a>
                    <a href="/register" class="hdr-btn hdr-btn-primary">
                        <i class="fa-solid fa-user-plus"></i> Register
                    </a>
                @endauth

                <a href="#" class="hdr-btn hdr-btn-primary" style="background:linear-gradient(135deg,#f59e0b,#d97706); box-shadow:0 4px 14px rgba(245,158,11,0.3);">
                    <i class="fa-solid fa-phone"></i> Call Now
                </a>

                <!-- Mobile Hamburger -->
                <button onclick="toggleMobile()" style="display:none; background:var(--sky-light); border:none; border-radius:10px; padding:10px 12px; cursor:pointer; color:var(--sky-dark);" class="mob-ham">
                    <i class="fa-solid fa-bars" style="font-size:1.1rem;"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- NAVBAR -->
    <nav class="main-nav" style="display:block;">
        <div style="max-width:1280px; margin:0 auto; padding:0 24px; display:flex; align-items:center; gap:36px;" class="nav-desktop">
            <a href="/" class="nav-link"><i class="fa-solid fa-house" style="margin-right:6px;"></i>Home</a>
            <a href="/products" class="nav-link"><i class="fa-solid fa-box-open" style="margin-right:6px;"></i>Products</a>
            <a href="#about" class="nav-link"><i class="fa-solid fa-star" style="margin-right:6px;"></i>About Us</a>

            <!-- Categories -->
            <div style="position:relative;">
                <button class="nav-link" onclick="toggleDropdown('catDrop', event)" style="background:none; border:none; cursor:pointer; display:flex; align-items:center; gap:6px; font-family:'DM Sans',sans-serif;">
                    <i class="fa-solid fa-grid-2"></i> Categories <i class="fa-solid fa-chevron-down" style="font-size:0.65rem;"></i>
                </button>
                <div id="catDrop" class="cat-dropdown">
                    @foreach($categories as $cat)
                        <a href="/category/{{ $cat->id }}">
                            <i class="fa-solid fa-tag" style="color:var(--sky); font-size:0.75rem;"></i>
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <a href="/contacts" class="nav-link"><i class="fa-solid fa-envelope" style="margin-right:6px;"></i>Contact</a>

            <!-- Spacer -->
            <div style="flex:1;"></div>

            <!-- Trust badges in nav -->
            <div style="display:flex; align-items:center; gap:16px; font-size:0.78rem; color:rgba(255,255,255,0.75);">
                <span><i class="fa-solid fa-truck-fast" style="margin-right:5px; color:#7dd3fc;"></i>Fast Delivery</span>
                <span><i class="fa-solid fa-shield-halved" style="margin-right:5px; color:#7dd3fc;"></i>Secure Orders</span>
                <span><i class="fa-solid fa-tags" style="margin-right:5px; color:#7dd3fc;"></i>Bulk Pricing</span>
            </div>
        </div>
    </nav>

    <!-- MOBILE MENU -->
    <div id="mobileMenu" class="mobile-menu">

        <!-- Mobile Search -->
        <div style="padding:16px; border-bottom:1px solid #e0f2fe; position:relative;">
            <i class="fa-solid fa-magnifying-glass" style="position:absolute; left:28px; top:50%; transform:translateY(-50%); color:var(--sky); font-size:0.9rem;"></i>
            <input type="text" placeholder="Search products..." style="width:100%; padding:10px 16px 10px 40px; border:2px solid #e0f2fe; border-radius:50px; font-family:'DM Sans',sans-serif; outline:none; background:#f0f9ff;">
        </div>

        @auth
            <div style="padding:12px 16px; background:var(--sky-light); border-bottom:1px solid #e0f2fe; display:flex; align-items:center; gap:10px;">
                <div style="width:36px; height:36px; background:linear-gradient(135deg,var(--sky),var(--sky-dark)); border-radius:50%; display:flex; align-items:center; justify-content:center; color:white; font-size:0.9rem;">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div>
                    <div style="font-weight:600; color:var(--sky-dark); font-size:0.9rem;">{{ auth()->user()->name }}</div>
                    <div style="font-size:0.75rem; color:#64748b;">{{ auth()->user()->email }}</div>
                </div>
            </div>
            <a href="/profile" class="mobile-nav-link"><i class="fa-solid fa-user" style="color:var(--sky); width:18px;"></i> My Profile</a>
            <a href="/cart" class="mobile-nav-link"><i class="fa-solid fa-cart-shopping" style="color:var(--sky); width:18px;"></i> My Cart</a>
            <a href="/my-orders" class="mobile-nav-link"><i class="fa-solid fa-box" style="color:var(--sky); width:18px;"></i> My Orders</a>
        @else
            <div style="padding:16px; display:flex; flex-direction:column; gap:10px; border-bottom:1px solid #e0f2fe;">
                <a href="/login" class="hdr-btn hdr-btn-outline" style="justify-content:center; border-radius:10px;"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                <a href="/register" class="hdr-btn hdr-btn-primary" style="justify-content:center; border-radius:10px;"><i class="fa-solid fa-user-plus"></i> Register</a>
            </div>
        @endauth

        <a href="/" class="mobile-nav-link"><i class="fa-solid fa-house" style="color:var(--sky); width:18px;"></i> Home</a>
        <a href="/products" class="mobile-nav-link"><i class="fa-solid fa-box-open" style="color:var(--sky); width:18px;"></i> Products</a>
        <a href="#about" class="mobile-nav-link"><i class="fa-solid fa-star" style="color:var(--sky); width:18px;"></i> About Us</a>

        <!-- Mobile Categories -->
        <button onclick="toggleMobileCats()" style="width:100%; display:flex; align-items:center; gap:12px; padding:14px 20px; border:none; background:white; border-bottom:1px solid #f0f9ff; font-family:'DM Sans',sans-serif; font-weight:500; cursor:pointer; font-size:1rem; color:var(--text-dark);">
            <i class="fa-solid fa-grid-2" style="color:var(--sky); width:18px;"></i> Categories
            <i class="fa-solid fa-chevron-down" id="catChevron" style="margin-left:auto; color:#94a3b8; transition:transform 0.3s;"></i>
        </button>
        <div id="mobileCats" style="display:none; background:var(--sky-light);">
            @foreach($categories as $cat)
                <a href="/category/{{ $cat->id }}" class="mobile-nav-link" style="padding-left:36px; font-size:0.9rem;">
                    <i class="fa-solid fa-tag" style="color:var(--sky); font-size:0.75rem;"></i> {{ $cat->name }}
                </a>
            @endforeach
        </div>

        <a href="/contacts" class="mobile-nav-link"><i class="fa-solid fa-envelope" style="color:var(--sky); width:18px;"></i> Contact</a>

        <div style="padding:16px; display:flex; gap:10px;">
            <a href="#" class="hdr-btn hdr-btn-primary" style="flex:1; justify-content:center; background:linear-gradient(135deg,#f59e0b,#d97706); box-shadow:none; border-radius:10px;">
                <i class="fa-solid fa-phone"></i> Call Now
            </a>
        </div>

        @auth
            <div style="padding:0 16px 16px;">
                <form action="/logout" method="POST">
                    @csrf
                    <button style="width:100%; padding:11px; background:#fef2f2; color:#dc2626; border:1px solid #fecaca; border-radius:10px; font-family:'DM Sans',sans-serif; font-weight:500; cursor:pointer;">
                        <i class="fa-solid fa-right-from-bracket" style="margin-right:8px;"></i> Logout
                    </button>
                </form>
            </div>
        @endauth
    </div>

    <!-- MAIN CONTENT -->
    <main style="min-height:75vh;">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="main-footer">

        <!-- Footer top wave -->
        <div style="background:white; line-height:0; margin-bottom:-1px;">
            <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" style="display:block; width:100%; height:60px;">
                <path d="M0,40 C360,80 1080,0 1440,40 L1440,60 L0,60 Z" fill="#075985"/>
            </svg>
        </div>

        <div style="max-width:1280px; margin:0 auto; padding:40px 24px 30px; display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:36px;">

            <!-- Brand -->
            <div>
                <div style="display:flex; align-items:center; gap:10px; margin-bottom:16px;">
                    <div class="logo-icon" style="background:rgba(255,255,255,0.15);">
                        <i class="fa-solid fa-globe"></i>
                    </div>
                    <span style="font-family:'Playfair Display',serif; font-size:1.4rem; font-weight:700; color:white;">Eurowide</span>
                </div>
                <p style="font-size:0.85rem; line-height:1.7; color:rgba(255,255,255,0.7);">Your trusted wholesale & direct delivery partner for FMCG products across the UK and internationally.</p>
                <div style="display:flex; gap:10px; margin-top:16px;">
                    <a href="#" style="width:34px; height:34px; background:rgba(255,255,255,0.1); border-radius:8px; display:flex; align-items:center; justify-content:center; color:rgba(255,255,255,0.8); text-decoration:none; transition:all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'"><i class="fa-brands fa-facebook-f" style="font-size:0.85rem;"></i></a>
                    <a href="#" style="width:34px; height:34px; background:rgba(255,255,255,0.1); border-radius:8px; display:flex; align-items:center; justify-content:center; color:rgba(255,255,255,0.8); text-decoration:none; transition:all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'"><i class="fa-brands fa-instagram" style="font-size:0.85rem;"></i></a>
                    <a href="#" style="width:34px; height:34px; background:rgba(255,255,255,0.1); border-radius:8px; display:flex; align-items:center; justify-content:center; color:rgba(255,255,255,0.8); text-decoration:none; transition:all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'"><i class="fa-brands fa-linkedin-in" style="font-size:0.85rem;"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 style="color:white; font-weight:600; margin-bottom:16px; font-size:0.95rem; letter-spacing:0.05em; text-transform:uppercase;">Quick Links</h4>
                <a href="/" class="footer-link"><i class="fa-solid fa-chevron-right" style="font-size:0.65rem; margin-right:8px; color:var(--sky-mid);"></i>Home</a>
                <a href="/products" class="footer-link"><i class="fa-solid fa-chevron-right" style="font-size:0.65rem; margin-right:8px; color:var(--sky-mid);"></i>Products</a>
                <a href="#about" class="footer-link"><i class="fa-solid fa-chevron-right" style="font-size:0.65rem; margin-right:8px; color:var(--sky-mid);"></i>About Us</a>
                <a href="/contacts" class="footer-link"><i class="fa-solid fa-chevron-right" style="font-size:0.65rem; margin-right:8px; color:var(--sky-mid);"></i>Contact</a>
            </div>

            <!-- Categories -->
            <div>
                <h4 style="color:white; font-weight:600; margin-bottom:16px; font-size:0.95rem; letter-spacing:0.05em; text-transform:uppercase;">Categories</h4>
                @foreach($categories as $cat)
                    <a href="/category/{{ $cat->id }}" class="footer-link"><i class="fa-solid fa-tag" style="font-size:0.65rem; margin-right:8px; color:var(--sky-mid);"></i>{{ $cat->name }}</a>
                @endforeach
            </div>

            <!-- Contact -->
            <div>
                <h4 style="color:white; font-weight:600; margin-bottom:16px; font-size:0.95rem; letter-spacing:0.05em; text-transform:uppercase;">Get In Touch</h4>
                <div style="display:flex; flex-direction:column; gap:10px; margin-bottom:20px;">
                    <a href="mailto:info@eurowide.com" class="footer-link" style="display:flex; align-items:center; gap:10px;"><span style="width:30px; height:30px; background:rgba(255,255,255,0.1); border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0;"><i class="fa-solid fa-envelope" style="font-size:0.8rem;"></i></span>info@eurowide.com</a>
                    <a href="tel:+919999999999" class="footer-link" style="display:flex; align-items:center; gap:10px;"><span style="width:30px; height:30px; background:rgba(255,255,255,0.1); border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0;"><i class="fa-solid fa-phone" style="font-size:0.8rem;"></i></span>+44 7000 000000</a>
                    <span class="footer-link" style="display:flex; align-items:flex-start; gap:10px;"><span style="width:30px; height:30px; background:rgba(255,255,255,0.1); border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0; margin-top:2px;"><i class="fa-solid fa-location-dot" style="font-size:0.8rem;"></i></span>UK & International</span>
                </div>

                <!-- Newsletter -->
                <div class="footer-newsletter">
                    <input type="email" placeholder="Your email for updates...">
                    <button><i class="fa-solid fa-paper-plane" style="margin-right:8px;"></i> Subscribe</button>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div style="border-top:1px solid rgba(255,255,255,0.1); padding:18px 24px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px; max-width:1280px; margin:0 auto; font-size:0.8rem; color:rgba(255,255,255,0.55);">
            <span>© 2026 Eurowide. All rights reserved.</span>
            <div style="display:flex; gap:16px;">
                <a href="#" style="color:rgba(255,255,255,0.55); text-decoration:none;">Privacy Policy</a>
                <a href="#" style="color:rgba(255,255,255,0.55); text-decoration:none;">Terms of Use</a>
            </div>
        </div>
    </footer>

    <style>
        @media (max-width: 900px) {
            .hdr-right > a:not(.mob-ham),
            .hdr-right > div,
            .hdr-right > button:not(.mob-ham) { display: none !important; }
            .mob-ham { display: flex !important; }
            .nav-desktop { display: none !important; }
            .main-nav { display: none !important; }
            .search-wrap { max-width: none; }
        }
        @media (max-width: 600px) {
            .logo span { display: none; }
        }
    </style>

    <script>
        function toggleDropdown(id, e) {
            e.stopPropagation();
            const el = document.getElementById(id);
            const allDrops = document.querySelectorAll('.dropdown-menu, .cat-dropdown');
            allDrops.forEach(d => { if (d !== el) d.classList.remove('show'); });
            el.classList.toggle('show');
        }

        document.addEventListener('click', () => {
            document.querySelectorAll('.dropdown-menu, .cat-dropdown, .search-results-drop').forEach(d => d.classList.remove('show'));
            document.getElementById('searchResults').style.display = 'none';
        });

        function toggleMobile() {
            const m = document.getElementById('mobileMenu');
            m.style.display = m.style.display === 'block' ? 'none' : 'block';
        }

        function toggleMobileCats() {
            const el = document.getElementById('mobileCats');
            const ch = document.getElementById('catChevron');
            const open = el.style.display === 'block';
            el.style.display = open ? 'none' : 'block';
            ch.style.transform = open ? 'rotate(0)' : 'rotate(180deg)';
        }

        function searchProducts(val) {
            const box = document.getElementById('searchResults');
            if (!val.trim()) { box.style.display = 'none'; return; }
            // Search logic - fetch from /search?q=val
            fetch(`/search?q=${encodeURIComponent(val)}`)
                .then(r => r.json())
                .then(data => {
                    if (!data.length) { box.style.display = 'none'; return; }
                    box.innerHTML = data.map(p => `
                        <a href="/product/${p.id}" style="display:flex; align-items:center; gap:12px; padding:10px 14px; text-decoration:none; color:var(--text-dark); border-bottom:1px solid #f0f9ff; transition:background 0.2s;" onmouseover="this.style.background='#f0f9ff'" onmouseout="this.style.background='white'">
                            <img src="/uploads/${p.image}" style="width:40px; height:40px; object-fit:contain; border-radius:8px; background:#f0f9ff; padding:4px;">
                            <span style="font-size:0.88rem; font-weight:500;">${p.title}</span>
                        </a>
                    `).join('');
                    box.style.display = 'block';
                }).catch(() => { box.style.display = 'none'; });
        }
    </script>

</body>
</html>