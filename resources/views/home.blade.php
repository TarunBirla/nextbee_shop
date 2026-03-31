@extends('layouts.app')

@section('content')

<style>
    :root {
        --sky: #0ea5e9;
        --sky-light: #e0f2fe;
        --sky-mid: #38bdf8;
        --sky-dark: #0369a1;
        --sky-deep: #075985;
        --accent: #f59e0b;
        --accent-light: #fef3c7;
        --text-dark: #0c2340;
        --text-mid: #374151;
    }

    /* HERO */
    .hero-section {
        position: relative;
        height: 520px;
        overflow: hidden;
        background: var(--sky-deep);
    }

    .hero-slide {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        transition: opacity 0.8s ease;
        opacity: 0;
    }

    .hero-slide.active { opacity: 1; }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(120deg, rgba(7,89,133,0.82) 0%, rgba(14,165,233,0.45) 40%, transparent 100%);
        z-index: 1;
    }

    .hero-content {
        position: absolute;
        inset: 0;
        z-index: 2;
        display: flex;
        align-items: center;
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 40px;
    }

    .hero-text { max-width: 560px; }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.15);
        border: 1px solid rgba(255,255,255,0.3);
        backdrop-filter: blur(8px);
        color: white;
        font-size: 0.8rem;
        font-weight: 500;
        padding: 6px 14px;
        border-radius: 50px;
        margin-bottom: 18px;
        letter-spacing: 0.04em;
    }

    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 800;
        color: white;
        line-height: 1.2;
        margin-bottom: 16px;
    }

    .hero-title span { color: #7dd3fc; }

    .hero-desc {
        color: rgba(255,255,255,0.85);
        font-size: 1rem;
        line-height: 1.7;
        margin-bottom: 28px;
    }

    .hero-btns { display: flex; gap: 12px; flex-wrap: wrap; }

    .hero-btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: white;
        color: var(--sky-dark);
        padding: 12px 24px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.25s;
        box-shadow: 0 6px 24px rgba(0,0,0,0.15);
    }

    .hero-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(0,0,0,0.2); }

    .hero-btn-secondary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.15);
        color: white;
        padding: 12px 24px;
        border-radius: 50px;
        font-weight: 500;
        font-size: 0.9rem;
        text-decoration: none;
        border: 1px solid rgba(255,255,255,0.4);
        backdrop-filter: blur(8px);
        transition: all 0.25s;
    }

    .hero-btn-secondary:hover { background: rgba(255,255,255,0.25); }

    /* Hero dots */
    .hero-dots {
        position: absolute;
        bottom: 24px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 3;
        display: flex;
        gap: 8px;
    }

    .hero-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: rgba(255,255,255,0.4);
        cursor: pointer;
        transition: all 0.3s;
        border: none;
    }

    .hero-dot.active { background: white; width: 24px; border-radius: 4px; }

    /* STATS BAR */
    .stats-bar {
        background: white;
        border-bottom: 2px solid var(--sky-light);
        box-shadow: 0 4px 20px rgba(14,165,233,0.08);
    }

    .stat-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 2px;
        padding: 20px 10px;
        border-right: 1px solid var(--sky-light);
    }

    .stat-item:last-child { border-right: none; }

    .stat-num {
        font-family: 'Playfair Display', serif;
        font-size: 1.6rem;
        font-weight: 800;
        color: var(--sky-dark);
    }

    .stat-label {
        font-size: 0.78rem;
        color: #64748b;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    /* FEATURES STRIP */
    .features-strip {
        background: linear-gradient(135deg, var(--sky-dark) 0%, var(--sky) 100%);
        padding: 32px 0;
    }

    .feature-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        text-align: center;
        padding: 0 16px;
        color: white;
    }

    .feature-icon-wrap {
        width: 56px;
        height: 56px;
        background: rgba(255,255,255,0.15);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        transition: all 0.3s;
    }

    .feature-card:hover .feature-icon-wrap {
        background: rgba(255,255,255,0.25);
        transform: translateY(-3px);
    }

    .feature-title { font-weight: 600; font-size: 0.9rem; }
    .feature-desc { font-size: 0.78rem; color: rgba(255,255,255,0.75); }

    /* SECTION */
    .section { padding: 70px 0; }

    .section-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--sky-light);
        color: var(--sky-dark);
        font-size: 0.78rem;
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 50px;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 12px;
    }

    .section-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.6rem, 3vw, 2.2rem);
        font-weight: 800;
        color: var(--text-dark);
        line-height: 1.25;
        margin-bottom: 16px;
    }

    .section-title span { color: var(--sky-dark); }

    /* ABOUT */
    .about-img-wrap {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(14,165,233,0.15);
    }

    .about-img-wrap img { width: 100%; display: block; }

    .about-img-badge {
        position: absolute;
        bottom: 20px;
        left: 20px;
        background: white;
        border-radius: 14px;
        padding: 14px 18px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.12);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .about-badge-icon {
        width: 40px;
        height: 40px;
        background: var(--sky-light);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--sky-dark);
        font-size: 1.1rem;
    }

    .about-cards {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
        margin-top: 28px;
    }

    .about-card {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px;
        border: 2px solid var(--sky-light);
        border-radius: 14px;
        text-decoration: none;
        color: var(--text-dark);
        transition: all 0.3s;
    }

    .about-card:hover {
        border-color: var(--sky);
        background: var(--sky-light);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(14,165,233,0.12);
    }

    .about-card-icon {
        width: 42px;
        height: 42px;
        background: var(--sky-light);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--sky-dark);
        font-size: 1.1rem;
        flex-shrink: 0;
        transition: all 0.3s;
    }

    .about-card:hover .about-card-icon { background: var(--sky-dark); color: white; }

    /* CATEGORIES */
    .cats-section { background: linear-gradient(180deg, #f0f9ff 0%, white 100%); }

    .cat-card {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 18px 20px;
        background: white;
        border: 2px solid var(--sky-light);
        border-radius: 16px;
        text-decoration: none;
        color: var(--text-dark);
        transition: all 0.3s;
        box-shadow: 0 2px 12px rgba(14,165,233,0.06);
    }

    .cat-card:hover {
        border-color: var(--sky);
        background: linear-gradient(135deg, var(--sky-dark), var(--sky));
        color: white;
        transform: translateY(-4px);
        box-shadow: 0 12px 36px rgba(14,165,233,0.25);
    }

    .cat-icon {
        width: 44px;
        height: 44px;
        background: var(--sky-light);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--sky-dark);
        font-size: 1.1rem;
        flex-shrink: 0;
        transition: all 0.3s;
    }

    .cat-card:hover .cat-icon { background: rgba(255,255,255,0.2); color: white; }
    .cat-card-arrow { margin-left: auto; opacity: 0; transition: all 0.3s; transform: translateX(-6px); }
    .cat-card:hover .cat-card-arrow { opacity: 1; transform: translateX(0); }

    /* PRODUCTS */
    .product-card {
        background: white;
        border: 2px solid #f0f9ff;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s;
        display: flex;
        flex-direction: column;
        box-shadow: 0 2px 12px rgba(14,165,233,0.06);
    }

    .product-card:hover {
        border-color: var(--sky-mid);
        transform: translateY(-6px);
        box-shadow: 0 20px 50px rgba(14,165,233,0.15);
    }

    .product-img-wrap {
        height: 200px;
        background: var(--sky-light);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
    }

    .product-img-wrap img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
        transition: transform 0.4s ease;
        padding: 16px;
    }

    .product-card:hover .product-img-wrap img { transform: scale(1.08); }

    .product-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: var(--sky-dark);
        color: white;
        font-size: 0.68rem;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 50px;
        letter-spacing: 0.04em;
    }

    .product-body { padding: 18px; flex: 1; display: flex; flex-direction: column; }

    .product-title {
        font-weight: 600;
        font-size: 0.95rem;
        color: var(--text-dark);
        margin-bottom: 6px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-desc {
        font-size: 0.82rem;
        color: #64748b;
        line-height: 1.6;
        margin-bottom: 14px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex: 1;
    }

    .product-price {
        font-family: 'Playfair Display', serif;
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--sky-dark);
        margin-bottom: 14px;
    }

    .product-price-lock {
        font-size: 0.8rem;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 5px;
        margin-bottom: 14px;
    }

    .product-actions { display: flex; gap: 8px; }

    .btn-view {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 10px;
        background: linear-gradient(135deg, var(--sky-dark), var(--sky));
        color: white;
        border-radius: 12px;
        font-size: 0.85rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.25s;
    }

    .btn-view:hover { box-shadow: 0 6px 18px rgba(14,165,233,0.35); transform: translateY(-1px); }

    .btn-cart {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 10px;
        background: var(--sky-light);
        color: var(--sky-dark);
        border-radius: 12px;
        font-size: 0.85rem;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: all 0.25s;
        width: 100%;
        font-family: 'DM Sans', sans-serif;
    }

    .btn-cart:hover { background: var(--sky-dark); color: white; }

    /* WHY US */
    .why-section { background: var(--sky-deep); color: white; }

    .why-card {
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 20px;
        padding: 28px 24px;
        text-align: center;
        transition: all 0.3s;
    }

    .why-card:hover {
        background: rgba(255,255,255,0.12);
        transform: translateY(-4px);
    }

    .why-icon {
        width: 60px;
        height: 60px;
        background: rgba(125,211,252,0.15);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin: 0 auto 16px;
        color: #7dd3fc;
    }

    /* VIEW ALL BTN */
    .view-all-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 22px;
        background: var(--sky-light);
        color: var(--sky-dark);
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.88rem;
        text-decoration: none;
        transition: all 0.25s;
        border: 2px solid var(--sky-light);
    }

    .view-all-btn:hover { background: var(--sky-dark); color: white; border-color: var(--sky-dark); }

    /* TESTIMONIALS */
    .testimonial-card {
        background: white;
        border: 2px solid var(--sky-light);
        border-radius: 20px;
        padding: 24px;
        transition: all 0.3s;
    }

    .testimonial-card:hover { border-color: var(--sky-mid); box-shadow: 0 12px 36px rgba(14,165,233,0.12); }

    /* CTA BANNER */
    .cta-banner {
        background: linear-gradient(135deg, var(--sky-dark) 0%, var(--sky) 100%);
        border-radius: 24px;
        padding: 50px 40px;
        position: relative;
        overflow: hidden;
    }

    .cta-banner::before {
        content: '';
        position: absolute;
        top: -60px;
        right: -60px;
        width: 280px;
        height: 280px;
        background: rgba(255,255,255,0.06);
        border-radius: 50%;
    }

    .cta-banner::after {
        content: '';
        position: absolute;
        bottom: -80px;
        right: 100px;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.04);
        border-radius: 50%;
    }

    .cta-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 13px 28px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.92rem;
        text-decoration: none;
        transition: all 0.25s;
    }

    .cta-btn-white { background: white; color: var(--sky-dark); }
    .cta-btn-white:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(0,0,0,0.15); }

    .cta-btn-outline { background: rgba(255,255,255,0.15); color: white; border: 2px solid rgba(255,255,255,0.4); }
    .cta-btn-outline:hover { background: rgba(255,255,255,0.25); }

    /* GRID HELPERS */
    .container { max-width: 1280px; margin: 0 auto; padding: 0 24px; }

    .grid-features { display: grid; grid-template-columns: repeat(4, 1fr); }
    .grid-about { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; }
    .grid-cats { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 14px; }
    .grid-products { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 20px; }
    .grid-why { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; }
    .grid-test { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
    .grid-stats { display: grid; grid-template-columns: repeat(4, 1fr); }

    @media (max-width: 900px) {
        .grid-features { grid-template-columns: repeat(2, 1fr); }
        .grid-about { grid-template-columns: 1fr; gap: 30px; }
        .grid-why { grid-template-columns: repeat(2, 1fr); }
        .grid-test { grid-template-columns: 1fr 1fr; }
        .grid-stats { grid-template-columns: repeat(2, 1fr); }
        .hero-section { height: 420px; }
    }

    @media (max-width: 600px) {
        .grid-features { grid-template-columns: 1fr 1fr; }
        .grid-why { grid-template-columns: 1fr 1fr; }
        .grid-test { grid-template-columns: 1fr; }
        .grid-stats { grid-template-columns: repeat(2, 1fr); }
        .about-cards { grid-template-columns: 1fr; }
        .cta-banner { padding: 36px 24px; }
        .hero-section { height: 360px; }
        .hero-btns { flex-direction: column; }
    }
</style>

<!-- HERO SLIDER -->
<div class="hero-section">
    <div class="hero-slide active" style="background-image: url('/chips.jpg');"></div>
    <div class="hero-slide" style="background-image: url('/drinks.jpg');"></div>
    <div class="hero-overlay"></div>

    <div class="hero-content">
        <div class="container" style="width:100%;">
            <div class="hero-text">
                <div class="hero-badge">
                    <i class="fa-solid fa-certificate" style="color:var(--accent);"></i>
                    Trusted Wholesale Since 2010
                </div>
                <h1 class="hero-title">
                    Premium Wholesale<br><span>FMCG Products</span><br>Delivered Fast
                </h1>
                <p class="hero-desc">
                    Supplying retailers, restaurants & caterers across the UK and internationally with bulk FMCG products at competitive prices.
                </p>
                <div class="hero-btns">
                    <a href="/products" class="hero-btn-primary">
                        <i class="fa-solid fa-box-open"></i> Browse Products
                    </a>
                    <a href="/contacts" class="hero-btn-secondary">
                        <i class="fa-solid fa-headset"></i> Get a Quote
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="hero-dots">
        <button class="hero-dot active" onclick="goToSlide(0)"></button>
        <button class="hero-dot" onclick="goToSlide(1)"></button>
    </div>
</div>

<!-- STATS BAR -->
<div class="stats-bar">
    <div class="container">
        <div class="grid-stats">
            <div class="stat-item">
                <div class="stat-num">5,000+</div>
                <div class="stat-label">Products</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">200+</div>
                <div class="stat-label">Brands</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">50+</div>
                <div class="stat-label">Countries</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">15yr+</div>
                <div class="stat-label">Experience</div>
            </div>
        </div>
    </div>
</div>

<!-- FEATURES STRIP -->
<div class="features-strip">
    <div class="container">
        <div class="grid-features">
            <div class="feature-card">
                <div class="feature-icon-wrap"><i class="fa-solid fa-truck-fast"></i></div>
                <div class="feature-title">Nationwide Delivery</div>
                <div class="feature-desc">Fast UK-wide dispatch</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon-wrap"><i class="fa-solid fa-shield-halved"></i></div>
                <div class="feature-title">100% Genuine</div>
                <div class="feature-desc">Authentic products guaranteed</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon-wrap"><i class="fa-solid fa-tags"></i></div>
                <div class="feature-title">Bulk Pricing</div>
                <div class="feature-desc">Exclusive wholesale rates</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon-wrap"><i class="fa-solid fa-headset"></i></div>
                <div class="feature-title">24/7 Support</div>
                <div class="feature-desc">Always here to help</div>
            </div>
        </div>
    </div>
</div>

<!-- CATEGORIES SECTION -->
<div class="cats-section section">
    <div class="container">
        <div style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:14px; margin-bottom:32px;">
            <div>
                <div class="section-label"><i class="fa-solid fa-grid-2"></i> Shop by Category</div>
                <h2 class="section-title">Browse Our <span>Product Range</span></h2>
            </div>
            <a href="/products" class="view-all-btn">View All <i class="fa-solid fa-arrow-right"></i></a>
        </div>

        <div class="grid-cats">
            @foreach($categories as $cat)
                <a href="/category/{{ $cat->id }}" class="cat-card">
                    <div class="cat-icon"><i class="fa-solid fa-tag"></i></div>
                    <span style="font-weight:600; font-size:0.9rem;">{{ $cat->name }}</span>
                    <i class="fa-solid fa-arrow-right cat-card-arrow" style="font-size:0.8rem;"></i>
                </a>
            @endforeach
        </div>
    </div>
</div>

<!-- ABOUT SECTION -->
<div class="section" id="about" style="background:white;">
    <div class="container">
        <div class="grid-about">

            <!-- Image -->
            <div class="about-img-wrap">
                <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d" alt="About Eurowide" style="height:440px; width:100%; object-fit:cover;">
                <div class="about-img-badge">
                    <div class="about-badge-icon"><i class="fa-solid fa-award"></i></div>
                    <div>
                        <div style="font-weight:700; color:var(--sky-dark); font-size:0.95rem;">Trusted Partner</div>
                        <div style="font-size:0.78rem; color:#64748b;">Since 2010</div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div>
                <div class="section-label"><i class="fa-solid fa-star"></i> About Eurowide</div>
                <h2 class="section-title">Your Reliable <span>Wholesale</span> & Delivery Partner</h2>
                <p style="color:#64748b; line-height:1.8; margin-bottom:20px; font-size:0.95rem;">
                    Eurowide Cash & Carry is your trusted wholesale and direct delivery partner, supplying FMCG products across the UK and internationally. With competitive pricing, fast service, and bulk supply, we cater to retailers, restaurants, and caterers.
                </p>
                <p style="color:#64748b; line-height:1.8; margin-bottom:24px; font-size:0.95rem;">
                    We ensure seamless nationwide and export delivery for your business needs, backed by our 15+ years of industry expertise.
                </p>

                <!-- Stats inline -->
                <div style="display:flex; gap:24px; margin-bottom:28px; flex-wrap:wrap;">
                    <div style="text-align:center;">
                        <div style="font-family:'Playfair Display',serif; font-size:1.8rem; font-weight:800; color:var(--sky-dark);">5K+</div>
                        <div style="font-size:0.8rem; color:#64748b; font-weight:500;">Products</div>
                    </div>
                    <div style="width:1px; background:#e0f2fe;"></div>
                    <div style="text-align:center;">
                        <div style="font-family:'Playfair Display',serif; font-size:1.8rem; font-weight:800; color:var(--sky-dark);">50+</div>
                        <div style="font-size:0.8rem; color:#64748b; font-weight:500;">Countries</div>
                    </div>
                    <div style="width:1px; background:#e0f2fe;"></div>
                    <div style="text-align:center;">
                        <div style="font-family:'Playfair Display',serif; font-size:1.8rem; font-weight:800; color:var(--sky-dark);">15yr</div>
                        <div style="font-size:0.8rem; color:#64748b; font-weight:500;">Experience</div>
                    </div>
                </div>

                <div class="about-cards">
                    <div class="about-card">
                        <div class="about-card-icon"><i class="fa-solid fa-building"></i></div>
                        <span style="font-weight:600; font-size:0.9rem;">Wholesalers</span>
                    </div>
                    <div class="about-card">
                        <div class="about-card-icon"><i class="fa-solid fa-store"></i></div>
                        <span style="font-weight:600; font-size:0.9rem;">Retailers</span>
                    </div>
                    <div class="about-card">
                        <div class="about-card-icon"><i class="fa-solid fa-truck"></i></div>
                        <span style="font-weight:600; font-size:0.9rem;">Distributors</span>
                    </div>
                    <div class="about-card">
                        <div class="about-card-icon"><i class="fa-solid fa-handshake"></i></div>
                        <span style="font-weight:600; font-size:0.9rem;">Trade Agents</span>
                    </div>
                </div>

                <div style="margin-top:28px;">
                    <a href="/contacts" style="display:inline-flex; align-items:center; gap:8px; background:linear-gradient(135deg,var(--sky-dark),var(--sky)); color:white; padding:13px 26px; border-radius:50px; font-weight:600; font-size:0.9rem; text-decoration:none; box-shadow:0 6px 18px rgba(14,165,233,0.3); transition:all 0.25s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 28px rgba(14,165,233,0.4)'" onmouseout="this.style.transform=''; this.style.boxShadow='0 6px 18px rgba(14,165,233,0.3)'">
                        <i class="fa-solid fa-envelope"></i> Get In Touch
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FEATURED PRODUCTS -->
<div class="section" style="background:linear-gradient(180deg, #f0f9ff 0%, white 100%);">
    <div class="container">
        <div style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:14px; margin-bottom:32px;">
            <div>
                <div class="section-label"><i class="fa-solid fa-fire"></i> Featured Products</div>
                <h2 class="section-title">Our <span>Top Picks</span> for You</h2>
            </div>
            <a href="/products" class="view-all-btn">All Products <i class="fa-solid fa-arrow-right"></i></a>
        </div>

        <div class="grid-products">
            @foreach($products as $p)
                <div class="product-card">
                    <div class="product-img-wrap">
                        <div class="product-badge">Wholesale</div>
                        <img src="/uploads/{{ $p->image }}" alt="{{ $p->title }}">
                    </div>
                    <div class="product-body">
                        <div class="product-title">{{ $p->title }}</div>
                        <div class="product-desc">{{ \Illuminate\Support\Str::limit($p->description, 80) }}</div>

                        @auth
                            <div class="product-price">£{{ $p->price }}</div>
                        @else
                            <div class="product-price-lock">
                                <i class="fa-solid fa-lock"></i> Login to see price
                            </div>
                        @endauth

                        <div class="product-actions">
                            <a href="/product/{{ $p->id }}" class="btn-view">
                                <i class="fa-solid fa-eye"></i> View
                            </a>
                            <form action="/add-to-cart/{{ $p->id }}" method="POST" style="flex:1;">
                                @csrf
                                <button type="submit" class="btn-cart">
                                    <i class="fa-solid fa-cart-plus"></i> Add
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- WHY CHOOSE US -->
<div class="why-section section">
    <div class="container">
        <div style="text-align:center; margin-bottom:40px;">
            <div class="section-label" style="background:rgba(255,255,255,0.12); color:#7dd3fc; display:inline-flex;">
                <i class="fa-solid fa-trophy"></i> Why Choose Us
            </div>
            <h2 class="section-title" style="color:white;">The <span style="color:#7dd3fc;">Eurowide</span> Advantage</h2>
        </div>
        <div class="grid-why">
            <div class="why-card">
                <div class="why-icon"><i class="fa-solid fa-globe"></i></div>
                <h3 style="font-weight:700; margin-bottom:8px; font-size:0.95rem;">Global Reach</h3>
                <p style="font-size:0.82rem; color:rgba(255,255,255,0.7); line-height:1.6;">Delivering to 50+ countries with reliable export solutions.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                <h3 style="font-weight:700; margin-bottom:8px; font-size:0.95rem;">Huge Stock</h3>
                <p style="font-size:0.82rem; color:rgba(255,255,255,0.7); line-height:1.6;">5,000+ FMCG products always available in our warehouse.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fa-solid fa-hand-holding-dollar"></i></div>
                <h3 style="font-weight:700; margin-bottom:8px; font-size:0.95rem;">Best Prices</h3>
                <p style="font-size:0.82rem; color:rgba(255,255,255,0.7); line-height:1.6;">Wholesale rates and bulk discounts tailored to your needs.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
                <h3 style="font-weight:700; margin-bottom:8px; font-size:0.95rem;">Fast Turnaround</h3>
                <p style="font-size:0.82rem; color:rgba(255,255,255,0.7); line-height:1.6;">Same or next day dispatch on most UK orders.</p>
            </div>
        </div>
    </div>
</div>

<!-- TESTIMONIALS -->
<div class="section" style="background:white;">
    <div class="container">
        <div style="text-align:center; margin-bottom:36px;">
            <div class="section-label"><i class="fa-solid fa-star"></i> Testimonials</div>
            <h2 class="section-title">What Our <span>Clients Say</span></h2>
        </div>
        <div class="grid-test">
            <div class="testimonial-card">
                <div style="color:var(--accent); margin-bottom:12px; font-size:0.9rem;">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p style="color:#64748b; font-size:0.88rem; line-height:1.7; margin-bottom:16px;">"Eurowide has been our go-to supplier for 3 years. Excellent pricing, fast delivery, and always reliable stock levels."</p>
                <div style="display:flex; align-items:center; gap:10px;">
                    <div style="width:38px; height:38px; background:var(--sky-light); border-radius:50%; display:flex; align-items:center; justify-content:center; color:var(--sky-dark); font-weight:700; font-size:0.9rem;">JM</div>
                    <div>
                        <div style="font-weight:600; font-size:0.88rem; color:var(--text-dark);">James M.</div>
                        <div style="font-size:0.75rem; color:#94a3b8;">Retail Store Owner, London</div>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <div style="color:var(--accent); margin-bottom:12px; font-size:0.9rem;">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p style="color:#64748b; font-size:0.88rem; line-height:1.7; margin-bottom:16px;">"Fantastic service! We've been ordering in bulk for our restaurants and the quality never disappoints. Highly recommended."</p>
                <div style="display:flex; align-items:center; gap:10px;">
                    <div style="width:38px; height:38px; background:var(--sky-light); border-radius:50%; display:flex; align-items:center; justify-content:center; color:var(--sky-dark); font-weight:700; font-size:0.9rem;">SR</div>
                    <div>
                        <div style="font-weight:600; font-size:0.88rem; color:var(--text-dark);">Sarah R.</div>
                        <div style="font-size:0.75rem; color:#94a3b8;">Restaurant Chain Manager</div>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <div style="color:var(--accent); margin-bottom:12px; font-size:0.9rem;">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i>
                </div>
                <p style="color:#64748b; font-size:0.88rem; line-height:1.7; margin-bottom:16px;">"Their international delivery network is impressive. We export to EU countries and the process is smooth every time."</p>
                <div style="display:flex; align-items:center; gap:10px;">
                    <div style="width:38px; height:38px; background:var(--sky-light); border-radius:50%; display:flex; align-items:center; justify-content:center; color:var(--sky-dark); font-weight:700; font-size:0.9rem;">AK</div>
                    <div>
                        <div style="font-weight:600; font-size:0.88rem; color:var(--text-dark);">Ahmed K.</div>
                        <div style="font-size:0.75rem; color:#94a3b8;">Export Trade Agent</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA BANNER -->
<div class="section" style="background:#f0f9ff;">
    <div class="container">
        <div class="cta-banner">
            <div style="position:relative; z-index:1; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:24px;">
                <div>
                    <h2 style="font-family:'Playfair Display',serif; font-size:clamp(1.5rem,2.5vw,2rem); font-weight:800; color:white; margin-bottom:10px;">Ready to Place a Bulk Order?</h2>
                    <p style="color:rgba(255,255,255,0.8); font-size:0.95rem;">Get in touch today for custom pricing and availability on large orders.</p>
                </div>
                <div style="display:flex; gap:12px; flex-wrap:wrap;">
                    <a href="/contacts" class="cta-btn cta-btn-white"><i class="fa-solid fa-envelope"></i> Contact Us</a>
                    <a href="tel:+447000000000" class="cta-btn cta-btn-outline"><i class="fa-solid fa-phone"></i> Call Now</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // HERO SLIDER
    let slides = document.querySelectorAll('.hero-slide');
    let dots = document.querySelectorAll('.hero-dot');
    let current = 0;

    function goToSlide(n) {
        slides[current].classList.remove('active');
        dots[current].classList.remove('active');
        current = n;
        slides[current].classList.add('active');
        dots[current].classList.add('active');
    }

    setInterval(() => {
        goToSlide((current + 1) % slides.length);
    }, 4000);
</script>

@endsection