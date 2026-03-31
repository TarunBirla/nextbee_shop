@extends('layouts.app')

@section('content')

<style>
    :root {
        --sky: #0ea5e9; --sky-light: #e0f2fe; --sky-mid: #38bdf8;
        --sky-dark: #0369a1; --sky-deep: #075985;
        --accent: #f59e0b; --text-dark: #0c2340;
    }

    .page-hero {
        background: linear-gradient(135deg, var(--sky-deep) 0%, var(--sky) 100%);
        padding: 44px 0;
        position: relative;
        overflow: hidden;
    }

    .page-hero::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 260px; height: 260px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }

    .page-hero::after {
        content: '';
        position: absolute;
        bottom: -80px; left: 100px;
        width: 200px; height: 200px;
        background: rgba(255,255,255,0.04);
        border-radius: 50%;
    }

    .page-hero-content { position: relative; z-index: 1; }

    .filter-bar {
        background: white;
        border-bottom: 2px solid var(--sky-light);
        padding: 14px 0;
        position: sticky;
        top: 0;
        z-index: 50;
        box-shadow: 0 4px 16px rgba(14,165,233,0.08);
    }

    .filter-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 18px;
        border-radius: 50px;
        font-size: 0.83rem;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.25s;
        border: 2px solid var(--sky-light);
        color: #64748b;
        background: white;
        white-space: nowrap;
    }

    .filter-pill:hover, .filter-pill.active {
        background: var(--sky-dark);
        color: white;
        border-color: var(--sky-dark);
    }

    .sort-select {
        padding: 9px 14px;
        border: 2px solid var(--sky-light);
        border-radius: 50px;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.83rem;
        font-weight: 500;
        color: var(--text-dark);
        outline: none;
        cursor: pointer;
        background: white;
        transition: border-color 0.2s;
    }

    .sort-select:focus { border-color: var(--sky-mid); }

    .search-filter {
        padding: 9px 16px 9px 38px;
        border: 2px solid var(--sky-light);
        border-radius: 50px;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.83rem;
        outline: none;
        transition: border-color 0.2s;
        background: #f0f9ff;
        min-width: 220px;
    }

    .search-filter:focus { border-color: var(--sky-mid); background: white; }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
        gap: 20px;
    }

    .p-card {
        background: white;
        border: 2px solid #f0f9ff;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s;
        display: flex;
        flex-direction: column;
        box-shadow: 0 2px 10px rgba(14,165,233,0.06);
        position: relative;
    }

    .p-card:hover {
        border-color: var(--sky-mid);
        transform: translateY(-5px);
        box-shadow: 0 18px 44px rgba(14,165,233,0.14);
    }

    .p-card-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: var(--sky-dark);
        color: white;
        font-size: 0.65rem;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 50px;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        z-index: 1;
    }

    .p-img-wrap {
        height: 190px;
        background: var(--sky-light);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
    }

    .p-img-wrap img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
        padding: 14px;
        transition: transform 0.4s ease;
    }

    .p-card:hover .p-img-wrap img { transform: scale(1.08); }

    .p-body { padding: 16px; flex: 1; display: flex; flex-direction: column; }

    .p-title {
        font-weight: 600;
        font-size: 0.92rem;
        color: var(--text-dark);
        margin-bottom: 5px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .p-desc {
        font-size: 0.8rem;
        color: #94a3b8;
        margin-bottom: 12px;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex: 1;
    }

    .p-price {
        font-family: 'Playfair Display', serif;
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--sky-dark);
        margin-bottom: 12px;
    }

    .p-price-lock {
        font-size: 0.78rem;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 4px;
        margin-bottom: 12px;
    }

    .p-actions { display: flex; gap: 8px; }

    .p-btn-view {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        padding: 10px;
        background: linear-gradient(135deg, var(--sky-dark), var(--sky));
        color: white;
        border-radius: 10px;
        font-size: 0.82rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.25s;
    }

    .p-btn-view:hover { box-shadow: 0 4px 14px rgba(14,165,233,0.35); }

    .p-btn-cart {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        padding: 10px;
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

    .p-btn-cart:hover { background: var(--sky-dark); color: white; }

    .no-products {
        grid-column: 1/-1;
        text-align: center;
        padding: 60px 20px;
        color: #94a3b8;
    }

    .results-count {
        font-size: 0.85rem;
        color: #64748b;
        font-weight: 500;
    }

    @media (max-width: 700px) {
        .filter-bar-inner { flex-wrap: wrap; gap: 10px; }
        .search-filter { min-width: 0; width: 100%; }
        .products-grid { grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 14px; }
        .p-img-wrap { height: 150px; }
    }
</style>

<!-- PAGE HERO -->
<div class="page-hero">
    <div class="page-hero-content" style="max-width:1280px; margin:0 auto; padding:0 24px;">
        <div style="display:inline-flex; align-items:center; gap:8px; background:rgba(255,255,255,0.12); border:1px solid rgba(255,255,255,0.25); color:rgba(255,255,255,0.9); font-size:0.75rem; font-weight:600; padding:5px 14px; border-radius:50px; margin-bottom:14px; letter-spacing:0.05em; text-transform:uppercase;">
            <i class="fa-solid fa-box-open"></i> Product Catalogue
        </div>
        <h1 style="font-family:'Playfair Display',serif; font-size:clamp(1.6rem,3vw,2.4rem); font-weight:800; color:white; margin-bottom:8px;">All Products</h1>
        <p style="color:rgba(255,255,255,0.75); font-size:0.92rem;">Browse our complete range of wholesale FMCG products</p>
    </div>
</div>

<!-- FILTER BAR -->
<div class="filter-bar">
    <div style="max-width:1280px; margin:0 auto; padding:0 24px; display:flex; align-items:center; gap:12px; flex-wrap:wrap;" class="filter-bar-inner">
        <!-- Search -->
        <div style="position:relative; flex:1; min-width:200px;">
            <i class="fa-solid fa-magnifying-glass" style="position:absolute; left:14px; top:50%; transform:translateY(-50%); color:var(--sky); font-size:0.85rem;"></i>
            <input type="text" id="filterSearch" class="search-filter" placeholder="Search products..." oninput="filterProducts()">
        </div>

        <!-- Category filters -->
        <div style="display:flex; gap:8px; flex-wrap:wrap;">
            <button class="filter-pill active" onclick="filterByCategory('all', this)">
                <i class="fa-solid fa-grid-2"></i> All
            </button>
            @foreach($categories ?? [] as $cat)
                <button class="filter-pill" onclick="filterByCategory('{{ $cat->id }}', this)">
                    {{ $cat->name }}
                </button>
            @endforeach
        </div>

        <!-- Sort -->
        <select class="sort-select" onchange="sortProducts(this.value)">
            <option value="">Sort by</option>
            <option value="az">Name A–Z</option>
            <option value="za">Name Z–A</option>
            <option value="low">Price: Low to High</option>
            <option value="high">Price: High to Low</option>
        </select>
    </div>
</div>

<!-- PRODUCTS SECTION -->
<div style="max-width:1280px; margin:0 auto; padding:32px 24px 64px;">

    <!-- Results count -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; flex-wrap:wrap; gap:10px;">
        <span class="results-count" id="resultsCount">Showing {{ count($products) }} products</span>
    </div>

    <div class="products-grid" id="productsGrid">
        @foreach($products as $p)
            <div class="p-card" data-title="{{ strtolower($p->title) }}" data-category="{{ $p->category_id ?? '' }}" data-price="{{ $p->price }}">
                <div class="p-card-badge">Wholesale</div>
                <div class="p-img-wrap">
                    <img src="/uploads/{{ $p->image }}" alt="{{ $p->title }}" loading="lazy">
                </div>
                <div class="p-body">
                    <div class="p-title">{{ $p->title }}</div>
                    <div class="p-desc">{{ \Illuminate\Support\Str::limit($p->description, 80) }}</div>

                    @auth
                        <div class="p-price">£{{ $p->price }}</div>
                    @else
                        <div class="p-price-lock"><i class="fa-solid fa-lock"></i> Login to view price</div>
                    @endauth

                    <div class="p-actions">
                        <a href="/product/{{ $p->id }}" class="p-btn-view">
                            <i class="fa-solid fa-eye"></i> View
                        </a>
                        <form action="/add-to-cart/{{ $p->id }}" method="POST" style="flex:1;">
                            @csrf
                            <button type="submit" class="p-btn-cart">
                                <i class="fa-solid fa-cart-plus"></i> Add
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        @if(count($products) === 0)
            <div class="no-products">
                <i class="fa-solid fa-box-open" style="font-size:3rem; margin-bottom:16px; display:block; color:#bae6fd;"></i>
                <h3 style="font-size:1.1rem; font-weight:600; color:#64748b; margin-bottom:8px;">No products found</h3>
                <p style="font-size:0.85rem;">Try adjusting your search or filters</p>
            </div>
        @endif
    </div>

    <!-- Pagination -->
    @if(method_exists($products, 'links'))
        <div style="margin-top:40px; display:flex; justify-content:center;">
            {{ $products->links() }}
        </div>
    @endif
</div>

<script>
    let activeCategoryId = 'all';

    function filterProducts() {
        const search = document.getElementById('filterSearch').value.toLowerCase();
        const cards = document.querySelectorAll('.p-card');
        let visible = 0;

        cards.forEach(card => {
            const title = card.dataset.title || '';
            const catId = card.dataset.category || '';
            const matchSearch = title.includes(search);
            const matchCat = activeCategoryId === 'all' || catId === activeCategoryId;

            if (matchSearch && matchCat) {
                card.style.display = '';
                visible++;
            } else {
                card.style.display = 'none';
            }
        });

        document.getElementById('resultsCount').textContent = `Showing ${visible} products`;
    }

    function filterByCategory(catId, btn) {
        activeCategoryId = catId;
        document.querySelectorAll('.filter-pill').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        filterProducts();
    }

    function sortProducts(val) {
        const grid = document.getElementById('productsGrid');
        const cards = Array.from(grid.querySelectorAll('.p-card'));

        cards.sort((a, b) => {
            const aTitle = a.dataset.title;
            const bTitle = b.dataset.title;
            const aPrice = parseFloat(a.dataset.price) || 0;
            const bPrice = parseFloat(b.dataset.price) || 0;

            if (val === 'az') return aTitle.localeCompare(bTitle);
            if (val === 'za') return bTitle.localeCompare(aTitle);
            if (val === 'low') return aPrice - bPrice;
            if (val === 'high') return bPrice - aPrice;
            return 0;
        });

        cards.forEach(c => grid.appendChild(c));
    }
</script>

@endsection