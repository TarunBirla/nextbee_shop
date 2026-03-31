@extends('layouts.app')

@section('content')

<style>
    :root { --sky:#0ea5e9; --sky-light:#e0f2fe; --sky-mid:#38bdf8; --sky-dark:#0369a1; --sky-deep:#075985; --accent:#f59e0b; --text-dark:#0c2340; }

    .page-hero { background:linear-gradient(135deg, var(--sky-deep) 0%, var(--sky) 100%); padding:44px 0; position:relative; overflow:hidden; }
    .page-hero::before { content:''; position:absolute; top:-60px; right:-60px; width:260px; height:260px; background:rgba(255,255,255,0.05); border-radius:50%; }

    .products-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(230px,1fr)); gap:20px; }

    .p-card { background:white; border:2px solid #f0f9ff; border-radius:20px; overflow:hidden; transition:all 0.3s; display:flex; flex-direction:column; box-shadow:0 2px 10px rgba(14,165,233,0.06); position:relative; }
    .p-card:hover { border-color:var(--sky-mid); transform:translateY(-5px); box-shadow:0 18px 44px rgba(14,165,233,0.14); }

    .p-card-badge { position:absolute; top:12px; left:12px; background:var(--sky-dark); color:white; font-size:0.65rem; font-weight:700; padding:3px 10px; border-radius:50px; text-transform:uppercase; letter-spacing:0.04em; z-index:1; }

    .p-img-wrap { height:190px; background:var(--sky-light); display:flex; align-items:center; justify-content:center; overflow:hidden; }
    .p-img-wrap img { max-height:100%; max-width:100%; object-fit:contain; padding:14px; transition:transform 0.4s; }
    .p-card:hover .p-img-wrap img { transform:scale(1.08); }

    .p-body { padding:16px; flex:1; display:flex; flex-direction:column; }
    .p-title { font-weight:600; font-size:0.92rem; color:var(--text-dark); margin-bottom:5px; line-height:1.4; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
    .p-desc { font-size:0.8rem; color:#94a3b8; margin-bottom:12px; line-height:1.5; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; flex:1; }
    .p-price { font-family:'Playfair Display',serif; font-size:1.2rem; font-weight:700; color:var(--sky-dark); margin-bottom:12px; }
    .p-price-lock { font-size:0.78rem; color:#94a3b8; display:flex; align-items:center; gap:4px; margin-bottom:12px; }
    .p-actions { display:flex; gap:8px; }

    .p-btn-view { flex:1; display:flex; align-items:center; justify-content:center; gap:5px; padding:10px; background:linear-gradient(135deg,var(--sky-dark),var(--sky)); color:white; border-radius:10px; font-size:0.82rem; font-weight:500; text-decoration:none; transition:all 0.25s; }
    .p-btn-view:hover { box-shadow:0 4px 14px rgba(14,165,233,0.35); }

    .p-btn-cart { flex:1; display:flex; align-items:center; justify-content:center; gap:5px; padding:10px; background:var(--sky-light); color:var(--sky-dark); border:none; border-radius:10px; font-size:0.82rem; font-weight:500; cursor:pointer; font-family:'DM Sans',sans-serif; transition:all 0.25s; width:100%; }
    .p-btn-cart:hover { background:var(--sky-dark); color:white; }

    .search-filter { padding:9px 16px 9px 38px; border:2px solid var(--sky-light); border-radius:50px; font-family:'DM Sans',sans-serif; font-size:0.83rem; outline:none; transition:border-color 0.2s; background:#f0f9ff; width:100%; max-width:280px; }
    .search-filter:focus { border-color:var(--sky-mid); background:white; }

    @media (max-width:600px) { .products-grid { grid-template-columns:repeat(auto-fill,minmax(160px,1fr)); gap:12px; } .p-img-wrap { height:150px; } }
</style>

<!-- PAGE HERO -->
<div class="page-hero">
    <div style="max-width:1280px; margin:0 auto; padding:0 24px; position:relative; z-index:1;">
        <!-- Breadcrumb -->
        <div style="display:flex; align-items:center; gap:8px; font-size:0.8rem; color:rgba(255,255,255,0.7); margin-bottom:14px; flex-wrap:wrap;">
            <a href="/" style="color:rgba(255,255,255,0.7); text-decoration:none; transition:color 0.2s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255,255,255,0.7)'"><i class="fa-solid fa-house" style="font-size:0.75rem;"></i> Home</a>
            <i class="fa-solid fa-chevron-right" style="font-size:0.6rem;"></i>
            <a href="/products" style="color:rgba(255,255,255,0.7); text-decoration:none;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">Products</a>
            <i class="fa-solid fa-chevron-right" style="font-size:0.6rem;"></i>
            <span style="color:white; font-weight:500;">{{ $category->name ?? 'Category' }}</span>
        </div>

        <div style="display:inline-flex; align-items:center; gap:8px; background:rgba(255,255,255,0.12); border:1px solid rgba(255,255,255,0.25); color:rgba(255,255,255,0.9); font-size:0.75rem; font-weight:600; padding:5px 14px; border-radius:50px; margin-bottom:14px; letter-spacing:0.05em; text-transform:uppercase;">
            <i class="fa-solid fa-tag"></i> Category
        </div>
        <h1 style="font-family:'Playfair Display',serif; font-size:clamp(1.6rem,3vw,2.4rem); font-weight:800; color:white; margin-bottom:8px;">{{ $category->name ?? 'Products' }}</h1>
        <p style="color:rgba(255,255,255,0.75); font-size:0.92rem;">Wholesale FMCG products in this category</p>
    </div>
</div>

<!-- CONTENT -->
<div style="max-width:1280px; margin:0 auto; padding:32px 24px 64px;">

    <!-- Top Bar -->
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:14px; margin-bottom:24px;">
        <span style="font-size:0.85rem; color:#64748b; font-weight:500;" id="resultsCount">
            Showing {{ count($products) }} product{{ count($products) !== 1 ? 's' : '' }}
        </span>

        <div style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
            <div style="position:relative;">
                <i class="fa-solid fa-magnifying-glass" style="position:absolute; left:14px; top:50%; transform:translateY(-50%); color:var(--sky); font-size:0.82rem;"></i>
                <input type="text" id="filterSearch" class="search-filter" placeholder="Search in category..." oninput="filterProducts()">
            </div>
            <select onchange="sortProducts(this.value)" style="padding:9px 14px; border:2px solid var(--sky-light); border-radius:50px; font-family:'DM Sans',sans-serif; font-size:0.83rem; font-weight:500; color:var(--text-dark); outline:none; cursor:pointer; background:white;">
                <option value="">Sort by</option>
                <option value="az">Name A–Z</option>
                <option value="za">Name Z–A</option>
                <option value="low">Price: Low to High</option>
                <option value="high">Price: High to Low</option>
            </select>
        </div>
    </div>

    <div class="products-grid" id="productsGrid">
        @forelse($products as $p)
            <div class="p-card" data-title="{{ strtolower($p->title) }}" data-price="{{ $p->price }}">
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
                        <a href="/product/{{ $p->id }}" class="p-btn-view"><i class="fa-solid fa-eye"></i> View</a>
                        <form action="/add-to-cart/{{ $p->id }}" method="POST" style="flex:1;">
                            @csrf
                            <button type="submit" class="p-btn-cart"><i class="fa-solid fa-cart-plus"></i> Add</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div style="grid-column:1/-1; text-align:center; padding:60px 20px; color:#94a3b8;">
                <i class="fa-solid fa-box-open" style="font-size:3rem; margin-bottom:16px; display:block; color:#bae6fd;"></i>
                <h3 style="font-size:1.1rem; font-weight:600; color:#64748b; margin-bottom:8px;">No products in this category yet</h3>
                <a href="/products" style="display:inline-flex; align-items:center; gap:8px; margin-top:14px; padding:10px 22px; background:var(--sky-dark); color:white; border-radius:50px; font-weight:600; font-size:0.88rem; text-decoration:none;">Browse All Products</a>
            </div>
        @endforelse
    </div>
</div>

<script>
    function filterProducts() {
        const search = document.getElementById('filterSearch').value.toLowerCase();
        const cards = document.querySelectorAll('.p-card');
        let visible = 0;
        cards.forEach(card => {
            const show = card.dataset.title.includes(search);
            card.style.display = show ? '' : 'none';
            if (show) visible++;
        });
        document.getElementById('resultsCount').textContent = `Showing ${visible} product${visible !== 1 ? 's' : ''}`;
    }

    function sortProducts(val) {
        const grid = document.getElementById('productsGrid');
        const cards = Array.from(grid.querySelectorAll('.p-card'));
        cards.sort((a, b) => {
            const aT = a.dataset.title, bT = b.dataset.title;
            const aP = parseFloat(a.dataset.price) || 0, bP = parseFloat(b.dataset.price) || 0;
            if (val === 'az') return aT.localeCompare(bT);
            if (val === 'za') return bT.localeCompare(aT);
            if (val === 'low') return aP - bP;
            if (val === 'high') return bP - aP;
            return 0;
        });
        cards.forEach(c => grid.appendChild(c));
    }
</script>

@endsection