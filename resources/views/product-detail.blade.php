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
        --text-dark: #0c2340;
        --text-mid: #374151;
    }

    /* BREADCRUMB */
    .breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 0.82rem; color: #64748b; margin-bottom: 28px; flex-wrap: wrap; }
    .breadcrumb a { color: var(--sky-dark); text-decoration: none; transition: color 0.2s; }
    .breadcrumb a:hover { color: var(--sky); }
    .breadcrumb-sep { color: #cbd5e1; }

    /* PRODUCT SECTION */
    .product-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: start; }

    /* IMAGE SIDE */
    .product-img-main {
        background: var(--sky-light);
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 440px;
        overflow: hidden;
        position: relative;
        border: 2px solid #bae6fd;
    }

    .product-img-main img {
        max-height: 90%;
        max-width: 90%;
        object-fit: contain;
        transition: transform 0.5s ease;
    }

    .product-img-main:hover img { transform: scale(1.06); }

    .img-badge {
        position: absolute;
        top: 16px;
        left: 16px;
        background: var(--sky-dark);
        color: white;
        font-size: 0.72rem;
        font-weight: 700;
        padding: 5px 12px;
        border-radius: 50px;
        letter-spacing: 0.05em;
        text-transform: uppercase;
    }

    /* DETAIL SIDE */
    .product-category-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--sky-light);
        color: var(--sky-dark);
        font-size: 0.75rem;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 50px;
        margin-bottom: 14px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .product-title-main {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.5rem, 2.5vw, 2rem);
        font-weight: 800;
        color: var(--text-dark);
        line-height: 1.25;
        margin-bottom: 14px;
    }

    .rating-row { display: flex; align-items: center; gap: 10px; margin-bottom: 18px; }
    .stars { color: var(--accent); letter-spacing: 2px; }
    .rating-text { font-size: 0.82rem; color: #64748b; }
    .rating-divider { width: 1px; height: 14px; background: #e2e8f0; }

    .product-desc-main {
        color: #64748b;
        line-height: 1.8;
        font-size: 0.93rem;
        margin-bottom: 24px;
        padding-bottom: 24px;
        border-bottom: 2px solid var(--sky-light);
    }

    .price-box {
        background: var(--sky-light);
        border: 2px solid #bae6fd;
        border-radius: 16px;
        padding: 18px 22px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .price-main {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        font-weight: 800;
        color: var(--sky-dark);
    }

    .price-label {
        font-size: 0.78rem;
        color: #64748b;
        font-weight: 500;
    }

    .price-lock {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 14px 18px;
        background: #fef3c7;
        border: 2px solid #fde68a;
        border-radius: 12px;
        color: #92400e;
        font-size: 0.85rem;
        font-weight: 500;
        margin-bottom: 24px;
    }

    /* QTY */
    .qty-row { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }
    .qty-label { font-size: 0.88rem; font-weight: 600; color: var(--text-dark); }
    .qty-ctrl { display: flex; align-items: center; border: 2px solid var(--sky-light); border-radius: 12px; overflow: hidden; }
    .qty-btn {
        width: 38px; height: 38px;
        background: var(--sky-light);
        border: none;
        cursor: pointer;
        font-size: 1rem;
        color: var(--sky-dark);
        font-weight: 700;
        transition: background 0.2s;
        display: flex; align-items: center; justify-content: center;
    }
    .qty-btn:hover { background: var(--sky-mid); color: white; }
    .qty-input {
        width: 52px;
        text-align: center;
        border: none;
        outline: none;
        font-family: 'DM Sans', sans-serif;
        font-weight: 600;
        font-size: 0.95rem;
        color: var(--text-dark);
    }

    /* ACTION BTNS */
    .action-row { display: flex; gap: 12px; margin-bottom: 24px; }

    .btn-cart-main {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 14px 20px;
        background: linear-gradient(135deg, var(--sky-dark), var(--sky));
        color: white;
        border: none;
        border-radius: 14px;
        font-size: 0.92rem;
        font-weight: 600;
        cursor: pointer;
        font-family: 'DM Sans', sans-serif;
        transition: all 0.25s;
        box-shadow: 0 6px 20px rgba(14,165,233,0.3);
        width: 100%;
    }

    .btn-cart-main:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(14,165,233,0.4); }

    .btn-wishlist {
        width: 50px;
        height: 50px;
        background: var(--sky-light);
        border: 2px solid #bae6fd;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--sky-dark);
        cursor: pointer;
        font-size: 1.1rem;
        transition: all 0.25s;
        flex-shrink: 0;
    }

    .btn-wishlist:hover { background: #fef2f2; border-color: #fca5a5; color: #dc2626; }

    /* TRUST BADGES */
    .trust-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-bottom: 20px;
    }

    .trust-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 12px;
        background: white;
        border: 2px solid var(--sky-light);
        border-radius: 12px;
        font-size: 0.78rem;
        font-weight: 500;
        color: #475569;
    }

    .trust-item i { color: var(--sky-dark); font-size: 0.9rem; }

    /* SHARE ROW */
    .share-row { display: flex; align-items: center; gap: 10px; }
    .share-label { font-size: 0.82rem; font-weight: 600; color: #64748b; }
    .share-btn {
        width: 32px; height: 32px;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        text-decoration: none;
        font-size: 0.82rem;
        transition: all 0.2s;
    }

    /* RELATED PRODUCTS */
    .related-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.6rem;
        font-weight: 800;
        color: var(--text-dark);
    }

    .related-title span { color: var(--sky-dark); }

    .section-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--sky-light);
        color: var(--sky-dark);
        font-size: 0.75rem;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 50px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 8px;
    }

    .rel-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 18px; }

    .rel-card {
        background: white;
        border: 2px solid #f0f9ff;
        border-radius: 18px;
        overflow: hidden;
        transition: all 0.3s;
        display: flex;
        flex-direction: column;
        box-shadow: 0 2px 10px rgba(14,165,233,0.06);
    }

    .rel-card:hover {
        border-color: var(--sky-mid);
        transform: translateY(-5px);
        box-shadow: 0 16px 40px rgba(14,165,233,0.14);
    }

    .rel-img {
        height: 180px;
        background: var(--sky-light);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .rel-img img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
        padding: 12px;
        transition: transform 0.4s;
    }

    .rel-card:hover .rel-img img { transform: scale(1.08); }

    .rel-body { padding: 16px; flex: 1; display: flex; flex-direction: column; }

    .rel-title {
        font-weight: 600;
        font-size: 0.9rem;
        color: var(--text-dark);
        margin-bottom: 5px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .rel-desc {
        font-size: 0.79rem;
        color: #94a3b8;
        margin-bottom: 12px;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex: 1;
    }

    .rel-price { font-family: 'Playfair Display', serif; font-size: 1.2rem; font-weight: 700; color: var(--sky-dark); margin-bottom: 12px; }
    .rel-price-lock { font-size: 0.78rem; color: #94a3b8; display: flex; align-items: center; gap: 4px; margin-bottom: 12px; }

    .rel-actions { display: flex; gap: 8px; }

    .rel-btn-view {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        padding: 9px;
        background: linear-gradient(135deg, var(--sky-dark), var(--sky));
        color: white;
        border-radius: 10px;
        font-size: 0.82rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.25s;
    }

    .rel-btn-view:hover { box-shadow: 0 4px 14px rgba(14,165,233,0.35); }

    .rel-btn-cart {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        padding: 9px;
        background: var(--sky-light);
        color: var(--sky-dark);
        border: none;
        border-radius: 10px;
        font-size: 0.82rem;
        font-weight: 500;
        cursor: pointer;
        font-family: 'DM Sans', sans-serif;
        transition: all 0.25s;
        width: 100%;
    }

    .rel-btn-cart:hover { background: var(--sky-dark); color: white; }

    @media (max-width: 900px) {
        .product-grid { grid-template-columns: 1fr; gap: 28px; }
        .product-img-main { height: 320px; }
        .trust-row { grid-template-columns: 1fr 1fr; }
    }

    @media (max-width: 600px) {
        .trust-row { grid-template-columns: 1fr; }
        .action-row { flex-direction: column; }
        .btn-wishlist { width: 100%; height: 48px; }
    }
</style>

<div style="max-width:1280px; margin:0 auto; padding:36px 24px 60px;">

    <!-- BREADCRUMB -->
    <div class="breadcrumb">
        <a href="/"><i class="fa-solid fa-house" style="font-size:0.78rem;"></i> Home</a>
        <span class="breadcrumb-sep"><i class="fa-solid fa-chevron-right" style="font-size:0.65rem;"></i></span>
        <a href="/products">Products</a>
        <span class="breadcrumb-sep"><i class="fa-solid fa-chevron-right" style="font-size:0.65rem;"></i></span>
        <span style="color:var(--sky-dark); font-weight:500;">{{ \Illuminate\Support\Str::limit($product->title, 40) }}</span>
    </div>

    <!-- MAIN PRODUCT -->
    <div class="product-grid">

        <!-- IMAGE -->
        <div>
            <div class="product-img-main">
                <div class="img-badge"><i class="fa-solid fa-certificate" style="margin-right:4px;"></i> Wholesale</div>
                <img src="/uploads/{{ $product->image }}" alt="{{ $product->title }}">
            </div>
        </div>

        <!-- DETAILS -->
        <div>
            <div class="product-category-tag">
                <i class="fa-solid fa-tag"></i> FMCG Product
            </div>

            <h1 class="product-title-main">{{ $product->title }}</h1>

            <div class="rating-row">
                <div class="stars">★★★★★</div>
                <span class="rating-text">4.5 / 5.0</span>
                <div class="rating-divider"></div>
                <span class="rating-text"><i class="fa-solid fa-comment" style="margin-right:4px; color:var(--sky-mid);"></i>Verified Product</span>
            </div>

            <p class="product-desc-main">{{ $product->description }}</p>

            <!-- PRICE -->
            @auth
                <div class="price-box">
                    <div>
                        <div class="price-label">Wholesale Price</div>
                        <div class="price-main">£{{ $product->price }}</div>
                    </div>
                    <div style="margin-left:auto; text-align:right;">
                        <div style="background:var(--sky-dark); color:white; font-size:0.7rem; font-weight:700; padding:4px 10px; border-radius:50px; margin-bottom:4px;">BULK AVAILABLE</div>
                        <div style="font-size:0.75rem; color:#64748b;">Contact for bulk rates</div>
                    </div>
                </div>
            @else
                <div class="price-lock">
                    <i class="fa-solid fa-lock" style="color:var(--accent);"></i>
                    <span>Login to view wholesale pricing — <a href="/login" style="color:var(--sky-dark); font-weight:700; text-decoration:none;">Login here →</a></span>
                </div>
            @endauth

            <!-- QUANTITY -->
            <div class="qty-row">
                <span class="qty-label">Quantity:</span>
                <div class="qty-ctrl">
                    <button class="qty-btn" onclick="changeQty(-1)">−</button>
                    <input type="number" id="qtyInput" class="qty-input" value="1" min="1">
                    <button class="qty-btn" onclick="changeQty(1)">+</button>
                </div>
                <span style="font-size:0.8rem; color:#94a3b8;">Min. order: 1 unit</span>
            </div>

            <!-- ACTIONS -->
            <div class="action-row">
                <form action="/add-to-cart/{{ $product->id }}" method="POST" style="flex:1; display:flex;">
                    @csrf
                    <button type="submit" class="btn-cart-main">
                        <i class="fa-solid fa-cart-plus"></i> Add to Cart
                    </button>
                </form>
                <button class="btn-wishlist" title="Save to wishlist">
                    <i class="fa-regular fa-heart"></i>
                </button>
            </div>

            <!-- TRUST BADGES -->
            <div class="trust-row">
                <div class="trust-item">
                    <i class="fa-solid fa-truck-fast"></i>
                    Fast Delivery
                </div>
                <div class="trust-item">
                    <i class="fa-solid fa-rotate-left"></i>
                    7-Day Returns
                </div>
                <div class="trust-item">
                    <i class="fa-solid fa-shield-halved"></i>
                    Genuine Product
                </div>
            </div>

            <!-- SHARE -->
            <div class="share-row">
                <span class="share-label">Share:</span>
                <a href="#" class="share-btn" style="background:#1877f2; color:white;" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="share-btn" style="background:#25d366; color:white;" title="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="#" class="share-btn" style="background:var(--sky-light); color:var(--sky-dark);" title="Copy link"><i class="fa-solid fa-link"></i></a>
            </div>
        </div>
    </div>

    <!-- TABS / PRODUCT INFO -->
    <div style="margin-top:52px; background:white; border:2px solid var(--sky-light); border-radius:20px; overflow:hidden;">

        <!-- Tab Headers -->
        <div style="display:flex; border-bottom:2px solid var(--sky-light);">
            <button onclick="switchTab('info')" id="tab-info" style="flex:1; padding:16px; font-weight:600; font-size:0.88rem; border:none; cursor:pointer; font-family:'DM Sans',sans-serif; background:var(--sky-light); color:var(--sky-dark); transition:all 0.2s; border-bottom:3px solid var(--sky-dark);">
                <i class="fa-solid fa-circle-info" style="margin-right:6px;"></i> Product Info
            </button>
            <button onclick="switchTab('delivery')" id="tab-delivery" style="flex:1; padding:16px; font-weight:600; font-size:0.88rem; border:none; cursor:pointer; font-family:'DM Sans',sans-serif; background:white; color:#64748b; transition:all 0.2s; border-bottom:3px solid transparent;">
                <i class="fa-solid fa-truck-fast" style="margin-right:6px;"></i> Delivery Info
            </button>
            <button onclick="switchTab('policy')" id="tab-policy" style="flex:1; padding:16px; font-weight:600; font-size:0.88rem; border:none; cursor:pointer; font-family:'DM Sans',sans-serif; background:white; color:#64748b; transition:all 0.2s; border-bottom:3px solid transparent;">
                <i class="fa-solid fa-shield-halved" style="margin-right:6px;"></i> Return Policy
            </button>
        </div>

        <div id="tab-content-info" style="padding:28px; color:#64748b; font-size:0.9rem; line-height:1.8;">
            <p><strong style="color:var(--text-dark);">Product:</strong> {{ $product->title }}</p>
            <p style="margin-top:10px;"><strong style="color:var(--text-dark);">Description:</strong> {{ $product->description }}</p>
            <p style="margin-top:10px;"><strong style="color:var(--text-dark);">Availability:</strong> <span style="color:#16a34a; font-weight:600;"><i class="fa-solid fa-circle-check"></i> In Stock</span></p>
        </div>

        <div id="tab-content-delivery" style="padding:28px; display:none; color:#64748b; font-size:0.9rem; line-height:1.8;">
            <p><i class="fa-solid fa-truck-fast" style="color:var(--sky); margin-right:8px;"></i> Same day dispatch for orders placed before 2PM</p>
            <p style="margin-top:10px;"><i class="fa-solid fa-globe" style="color:var(--sky); margin-right:8px;"></i> UK nationwide delivery available</p>
            <p style="margin-top:10px;"><i class="fa-solid fa-plane" style="color:var(--sky); margin-right:8px;"></i> International export orders available — contact us for rates</p>
            <p style="margin-top:10px;"><i class="fa-solid fa-money-bill-wave" style="color:var(--sky); margin-right:8px;"></i> Cash on delivery supported for select areas</p>
        </div>

        <div id="tab-content-policy" style="padding:28px; display:none; color:#64748b; font-size:0.9rem; line-height:1.8;">
            <p><i class="fa-solid fa-rotate-left" style="color:var(--sky); margin-right:8px;"></i> 7-day hassle-free return policy on all products</p>
            <p style="margin-top:10px;"><i class="fa-solid fa-shield-halved" style="color:var(--sky); margin-right:8px;"></i> Items must be returned in original condition and packaging</p>
            <p style="margin-top:10px;"><i class="fa-solid fa-headset" style="color:var(--sky); margin-right:8px;"></i> Contact our support team to initiate a return</p>
        </div>
    </div>

    <!-- RELATED PRODUCTS -->
    <div style="margin-top:64px;">
        <div style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:14px; margin-bottom:28px;">
            <div>
                <div class="section-label"><i class="fa-solid fa-layer-group"></i> Related Items</div>
                <h2 class="related-title">You May Also <span>Like</span></h2>
            </div>
            <a href="/products" style="display:inline-flex; align-items:center; gap:8px; padding:9px 20px; background:var(--sky-light); color:var(--sky-dark); border-radius:50px; font-weight:600; font-size:0.85rem; text-decoration:none; border:2px solid var(--sky-light); transition:all 0.25s;" onmouseover="this.style.background='var(--sky-dark)'; this.style.color='white'" onmouseout="this.style.background='var(--sky-light)'; this.style.color='var(--sky-dark)'">
                All Products <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="rel-grid">
            @foreach($relatedProducts as $rel)
                <div class="rel-card">
                    <div class="rel-img">
                        <img src="/uploads/{{ $rel->image }}" alt="{{ $rel->title }}">
                    </div>
                    <div class="rel-body">
                        <div class="rel-title">{{ $rel->title }}</div>
                        <div class="rel-desc">{{ \Illuminate\Support\Str::limit($rel->description, 80) }}</div>

                        @auth
                            <div class="rel-price">£{{ $rel->price }}</div>
                        @else
                            <div class="rel-price-lock"><i class="fa-solid fa-lock"></i> Login to view price</div>
                        @endauth

                        <div class="rel-actions">
                            <a href="/product/{{ $rel->id }}" class="rel-btn-view">
                                <i class="fa-solid fa-eye"></i> View
                            </a>
                            <form action="/add-to-cart/{{ $rel->id }}" method="POST" style="flex:1;">
                                @csrf
                                <button type="submit" class="rel-btn-cart">
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

<script>
    function changeQty(delta) {
        const input = document.getElementById('qtyInput');
        const val = parseInt(input.value) + delta;
        if (val >= 1) input.value = val;
    }

    function switchTab(tab) {
        ['info', 'delivery', 'policy'].forEach(t => {
            document.getElementById('tab-content-' + t).style.display = t === tab ? 'block' : 'none';
            const btn = document.getElementById('tab-' + t);
            if (t === tab) {
                btn.style.background = 'var(--sky-light)';
                btn.style.color = 'var(--sky-dark)';
                btn.style.borderBottom = '3px solid var(--sky-dark)';
            } else {
                btn.style.background = 'white';
                btn.style.color = '#64748b';
                btn.style.borderBottom = '3px solid transparent';
            }
        });
    }
</script>

@endsection