@extends('layouts.app')

@section('content')

    <div class="max-w-7xl mx-auto p-6">

        <h2 class="text-2xl font-bold mb-6">My Ordered Products</h2>

        <div class="grid lg:grid-cols-3 gap-8">

            <!-- LEFT TABLE -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow overflow-hidden">

                    <div class="p-4 bg-gray-50 border-b flex justify-between">
                        <h4 class="text-sm font-bold text-gray-600">Order Products</h4>
                        <button onclick="openModal()" class="mb-4 bg-blue-600 text-white px-6 py-2 rounded">
                            + Create Order
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="p-4 text-xs">#</th>
                                    <th class="p-4 text-xs">Product</th>
                                    <th class="p-4 text-xs text-center">Qty</th>
                                    <th class="p-4 text-xs">Price</th>
                                    <th class="p-4 text-xs">Total</th>
                                </tr>
                            </thead>

                            <tbody id="sales-line-body">
                                <!-- JS fill karega -->
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>

            <!-- RIGHT SUMMARY -->
            <form method="POST" action="{{ route('order.reorder.submit') }}" onsubmit="prepareForm()">
                @csrf

                <div class="bg-white p-6 rounded-2xl shadow">

                    <h4 class="text-sm font-bold text-blue-600 mb-6">Summary</h4>

                    <div class="space-y-3 text-sm">

                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span id="subtotal">£0</span>
                        </div>

                        <div class="flex justify-between">
                            <span>Tax (20%)</span>
                            <span id="tax">£0</span>
                        </div>

                        <!-- hidden inputs -->
                        <div id="formProducts"></div>

                        <!-- COUPON -->
                        <div class="mt-4">
                            <div class="flex gap-2">
                                <input type="text" id="couponInput" placeholder="Enter coupon (SAVE10 / FLAT50)"
                                    class="border p-2 rounded w-full">

                                <button type="button" onclick="applyCoupon()" class="bg-green-600 text-white px-4 rounded">
                                    Apply
                                </button>
                            </div>

                            <p id="couponMsg" class="text-xs mt-2 font-semibold"></p>

                            <input type="hidden" name="coupon" id="couponField">
                        </div>

                        <div class="flex justify-between font-bold border-t pt-4">
                            <span>Total</span>
                            <span id="grandTotal">£0</span>
                        </div>

                        <!-- SUBMIT BUTTON -->
                        <button type="submit" class="mt-4 bg-blue-600 text-white px-6 py-2 rounded w-full">
                            Place Order
                        </button>

                    </div>

                </div>
            </form>

        </div>

    </div>

    <!-- MODAL -->
    <!-- MODAL -->
<div id="productModal" class="fixed mt-20 inset-0 bg-black bg-opacity-50 hidden justify-center items-center">

    <div class="bg-white w-4/5 max-h-[85vh] overflow-y-auto rounded-xl p-6">

        <!-- HEADER -->
        <div class="flex justify-between mb-4">
            <h3 class="text-lg font-bold">Select Products</h3>
            <button onclick="closeModal()" class="text-red-500">✖</button>
        </div>

        <!-- FILTERS -->
        <div class="flex gap-3 mb-4">

            <!-- SEARCH -->
            <input type="text" id="searchInput"
                placeholder="Search product..."
                class="border p-2 rounded w-full"
                onkeyup="filterProducts()">

            <!-- CATEGORY -->
            <select id="categoryFilter" onchange="filterProducts()"
                class="border p-2 rounded">
                <option value="">All Category</option>

                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>

        </div>

        <!-- PRODUCTS -->
        <div class="grid grid-cols-4 gap-4" id="productList">

            @foreach($products as $product)
                <div class="border p-3 rounded product-item"
                    data-name="{{ strtolower($product->title) }}"
                    data-category="{{ $product->category_id }}">

                    <input type="checkbox" class="product-check"
                        value="{{ $product->id }}"
                        data-name="{{ $product->title }}"
                        data-price="{{ $product->price }}">

                    <img src="/uploads/{{ $product->image }}" class="h-20 mx-auto my-2">

                    <p class="text-sm font-bold">{{ $product->title }}</p>
                    <p class="text-blue-600">£{{ $product->price }}</p>

                </div>
            @endforeach

        </div>

        <!-- ADD BUTTON -->
        <div class="mt-6 text-right">
            <button onclick="addSelectedProducts()"
                class="bg-blue-600 text-white px-6 py-2 rounded">
                Add Selected
            </button>
        </div>

    </div>
</div>
    <!-- JS -->
    <script>

        function filterProducts() {

    let search = document.getElementById('searchInput').value.toLowerCase();
    let category = document.getElementById('categoryFilter').value;

    let items = document.querySelectorAll('.product-item');

    items.forEach(item => {

        let name = item.getAttribute('data-name');
        let cat = item.getAttribute('data-category');

        let matchSearch = name.includes(search);
        let matchCategory = category === '' || category === cat;

        if (matchSearch && matchCategory) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }

    });
}
        function openModal() {
            document.getElementById('productModal').classList.remove('hidden');
            document.getElementById('productModal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('productModal').classList.add('hidden');
        }
        let tableProducts = {};

        // 🔥 LOAD ALL PRODUCTS FROM LARAVEL
        window.onload = function () {

            @foreach($items as $item)
                @if($item->product)
                    addToTable(
                        "{{ $item->product->id }}",
                        "{{ $item->product->title }}",
                        "{{ $item->product->price }}",
                        "{{ $item->quantity }}"
                    );
                @endif
            @endforeach

                        };


        // ADD PRODUCT
        function addToTable(id, name, price, qty = 1) {

            if (!tableProducts[id]) {
                tableProducts[id] = {
                    name: name,
                    price: parseFloat(price),
                    qty: parseInt(qty)
                };
            } else {
                tableProducts[id].qty += parseInt(qty);
            }

            renderTable();
        }

        function selectProduct(id, name, price) {
            addToTable(id, name, price, 1);
            closeModal();
        }
        function addSelectedProducts() {

    let checked = document.querySelectorAll('.product-check:checked');

    if (checked.length === 0) {
        alert('Please select at least one product');
        return;
    }

    checked.forEach(item => {

        let id = item.value;
        let name = item.getAttribute('data-name');
        let price = item.getAttribute('data-price');

        addToTable(id, name, price, 1);

        item.checked = false; // reset
    });

    closeModal();
}
        // RENDER TABLE
        function renderTable() {

            let tbody = document.getElementById('sales-line-body');
            tbody.innerHTML = '';

            let subtotal = 0;
            let i = 1;

            for (let id in tableProducts) {

                let item = tableProducts[id];
                let lineTotal = item.qty * item.price;

                subtotal += lineTotal;

                tbody.innerHTML += `
    <tr class="border-b">
        <td class="p-4">${i++}</td>

        <td class="p-4 font-semibold">${item.name}</td>

        <td class="p-4 text-center">
            <input type="number"
                value="${item.qty}"
                min="1"
                onchange="updateQty('${id}', this.value)"
                class="w-16 border rounded text-center">
        </td>

        <td class="p-4">£${item.price}</td>

        <td class="p-4 text-blue-600 font-bold">
            £${lineTotal.toFixed(2)}
        </td>

        <td class="p-4">
            <button onclick="removeItem('${id}')"
                class="text-red-600 font-bold">
                ❌
            </button>
        </td>
    </tr>`;
            }

            updateSummary(subtotal);
        }

        function removeItem(id) {
    delete tableProducts[id];
    renderTable();
}

        // UPDATE QTY
        function updateQty(id, qty) {
            qty = parseInt(qty);
            if (qty < 1) qty = 1;

            tableProducts[id].qty = qty;

            renderTable();
        }

        let appliedCoupon = '';
        let discountValue = 0;

        function applyCoupon() {

            let input = document.getElementById('couponInput').value.trim();
            let msg = document.getElementById('couponMsg');

            if (input === 'SAVE10') {
                appliedCoupon = 'SAVE10';
                msg.innerHTML = '✅ 10% discount applied';
                msg.style.color = 'green';
            }
            else if (input === 'FLAT50') {
                appliedCoupon = 'FLAT50';
                msg.innerHTML = '✅ £50 discount applied';
                msg.style.color = 'green';
            }
            else {
                appliedCoupon = '';
                msg.innerHTML = '❌ Invalid coupon';
                msg.style.color = 'red';
            }

            // hidden field me set karo (Laravel ke liye)
            document.getElementById('couponField').value = appliedCoupon;

            renderTable(); // 🔥 update price
        }
        function updateSummary(subtotal) {

            let discount = 0;

            if (appliedCoupon === 'SAVE10') {
                discount = subtotal * 0.10;
            }

            if (appliedCoupon === 'FLAT50') {
                discount = 50;
            }

            let tax = (subtotal - discount) * 0.2;
            let total = subtotal - discount + tax;

            document.getElementById('subtotal').innerText = '£' + subtotal.toFixed(2);
            document.getElementById('tax').innerText = '£' + tax.toFixed(2);
            document.getElementById('grandTotal').innerText = '£' + total.toFixed(2);
        }

        function prepareForm() {

            let container = document.getElementById('formProducts');
            container.innerHTML = '';

            let index = 0;

            for (let id in tableProducts) {

                let item = tableProducts[id];

                container.innerHTML += `
                                    <input type="hidden" name="products[${index}][id]" value="${id}">
                                    <input type="hidden" name="products[${index}][qty]" value="${item.qty}">
                                `;

                index++;
            }
        }
        document.getElementById('couponInput')?.addEventListener('input', function () {
            renderTable();
        });
    </script>

@endsection