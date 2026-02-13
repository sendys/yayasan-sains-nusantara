@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Tables';
    $title = 'Point Of Sales (POS)';
    ?>
    @include('layouts.partials.page-title')
    @include('layouts.partials.preloader')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body shadow-bottom">
                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <h5 class="mb-0">
                                <span class="fw-bold text-primary">WELCOME</span> <span class="fw-bold">FINTEK</span>
                            </h5>
                            <div>
                                <span class="text-primary fw-bold" id="clock"></span> |

                                <script>
                                    function updateClock() {
                                        const now = new Date();
                                        const hours = now.getHours().toString().padStart(2, '0');
                                        const minutes = now.getMinutes().toString().padStart(2, '0');
                                        const seconds = now.getSeconds().toString().padStart(2, '0');
                                        const ampm = hours >= 12 ? 'PM' : 'AM';
                                        const hours12 = hours % 12 || 12;
                                        const time = `${hours12.toString().padStart(2,'0')}:${minutes}:${seconds} ${ampm}`;

                                        document.getElementById('clock').textContent = time;
                                    }

                                    // Update clock immediately and every second 
                                    updateClock();
                                    setInterval(updateClock, 1000);
                                </script>
                                <span>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
                            </div>

                        </div>
                        <div class="col-auto">
                            {{--  <div class="text-lg-end my-1 my-lg-0">
                                <a href="#" class="btn btn-info waves-effect waves-light"><i
                                        class="mdi mdi-file-import"></i></a>
                            </div> --}}
                            <div class="text-lg-end my-1 my-lg-0">
                                <button class="btn btn-secondary"><i class="bi bi-display"></i></button>
                                <button class="btn btn-warning"><i class="bi bi-folder-fill"></i><span
                                        class="badge bg-danger">0</span></button>
                                <button class="btn btn-danger"><i class="bi bi-cart-fill"></i><span
                                        class="badge bg-warning">0</span></button>
                                <button class="btn btn-primary"><i class="bi bi-arrows-fullscreen"></i></button>
                                <button class="btn btn-dark"><i class="bi bi-moon"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-5 d-none d-md-block">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="fw-bold mb-2">Select Brand</h6>
                            <div class="d-flex mb-2">
                                <select class="form-select me-2">
                                    <option>Semua</option>
                                    <!-- Tambahkan opsi brand lainnya -->
                                </select>
                                <input type="text" class="form-control" placeholder="Search">
                            </div>

                            <!-- Card Produk -->
                            <div class="card text-center">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="scrollbar-vertical" style="height: 510px; overflow-y: scroll;">
                                            <div class="row">
                                                @foreach ($products as $product)
                                                    <div class="col-lg-4">
                                                        <div class="shadow-sm p-2 mb-3 bg-white rounded product-card"
                                                            onclick="addToOrder('{{ $product->product_name }}', {{ $product->selling_price }}, '{{ asset($product->id) }}')"
                                                            style="cursor: pointer">
                                                            <img src="{{ asset($product->image) }}"
                                                                class="rounded-circle mb-2"
                                                                alt="{{ $product->product_name }}" width="100"
                                                                height="100">
                                                            <p class="mb-1">{{ $product->product_name }}</p>
                                                            <div
                                                                class="d-flex justify-content-between align-items-center px-2">
                                                                {{--  <span class="badge bg-success">{{ $product->id }}</span> --}}
                                                                <span
                                                                    class="badge bg-success">{{ $product->kategori->nama }}</span>
                                                                <span class="text-primary text-center fw-bold d-block">
                                                                    {{ number_format($product->selling_price, 0, ',', '.') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-2">
                                <label class="form-label fw-bold">Barcode</label>
                                <input type="text" class="form-control" id="barcode-input"
                                    onkeypress="searchByBarcode(event)" placeholder="Scan barcode...">
                            </div>

                            <div class="table-responsive">
                                <div class="d-none d-md-block" style="height: 400px; overflow-y: scroll;">
                                    <!-- Desktop/Tablet View -->
                                    <table class="table table-bordered align-middle text-center">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 50%">Nama</th>
                                                <th style="width: 8%">Qty</th>
                                                <th style="width: 10%">Diskon</th>
                                                <th style="width: 10%">Sub Total</th>
                                                <th style="width: 5%"></th>
                                                <th style="width: 10%">ID</th>
                                            </tr>
                                        </thead>
                                        <tbody id="order-body">
                                            {{-- tbody --}}
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Mobile View -->
                                <div class="d-block d-md-none">
                                    @for ($i = 1; $i <= 3; $i++)
                                        <div class="card mb-2">
                                            <div class="card-body p-2">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <h6 class="mb-0 fw-bold">Product {{ $i }}</h6>
                                                    <button class="btn btn-xs btn-danger"><i
                                                            class="bi bi-trash"></i></button>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col-6">
                                                        <div class="input-group input-group-sm">
                                                            <span class="input-group-text">Qty</span>
                                                            <input type="number" class="form-control" value="1"
                                                                min="1">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="input-group input-group-sm">
                                                            <span class="input-group-text">Disc</span>
                                                            <input type="text" class="form-control" value="Rp 0"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end align-items-center mt-2">
                                                    <span class="fw-bold">Rp 3.000 <i
                                                            class="bi bi-pencil-square ms-1 text-muted"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>

                            <!-- Summary -->
                            <div class="mt-2 text-end">
                                <div class="d-flex justify-content-between">
                                    <span>Total Item</span>
                                    <span id="total-item">0</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Sub Total</span>
                                    <span id="sub-total">0</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Diskon</span>
                                    <span id="diskon-total">0</span>
                                </div>
                                <div class="d-flex justify-content-between border-bottom">
                                    <span>Tax 0%</span>
                                    <span id="tax-total">0</span>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <span style="font-size: 20px; font-weight: bold;">Total</span>
                                    <span style="font-size: 20px; font-weight: bold;" class="text-primary"
                                        id="grand-total">0</span>
                                </div>
                                <div class="mt-2 d-flex justify-content-end gap-1">
                                    <button class="btn btn-danger">Hapus</button>
                                    <button class="btn btn-warning">Draft</button>
                                    <button class="btn btn-primary">Bayar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script>
        const orderItems = {};

        function getProductIdFromUrl() {
            const path = window.location.pathname;
            return path.split('/').filter(Boolean).pop(); // hasil: "5"
        }


        function addToOrder(nama, harga) {
            const productID = getProductIdFromUrl();
            const tbody = document.getElementById('order-body');

            if (orderItems[id]) {
                const row = document.getElementById(orderItems[id].rowId);
                const qtyInput = row.querySelector('.qty-input');

                qtyInput.value = parseInt(qtyInput.value) + 1;
                updateSubtotal(row, harga);
            } else {
                const rowId = 'row-' + id;
                orderItems[id] = {
                    rowId,
                    harga
                };

                const row = document.createElement('tr');
                row.id = rowId;

                row.innerHTML = `
                    <td style="text-align: left">
                        ${nama}
                    </td>
                    <td>
                        <input type="number" value="1" min="1" class="form-control qty-input" style="width: 60px"
                            onchange="updateSubtotal(document.getElementById('${rowId}'), ${harga})">
                    </td>
                    <td>
                        <input type="number" value="0" min="0" class="form-control diskon-input" style="width: 80px"
                            onchange="updateSubtotal(document.getElementById('${rowId}'), ${harga})">
                    </td>
                    <td class="subtotal">${harga.toLocaleString('id-ID')}</td>
                    <td>
                        <button class="btn btn-sm btn-danger" onclick="removeRow('${rowId}', '${key}')">x</button>
                    </td>
                  <td>
            <input type="hidden" name="product_id[]" value="${productID}" class="product_id">
            ${productID}
        </td>
                `;

                tbody.appendChild(row);
            }

            calculateTotals();
        }

        function updateSubtotal(row, harga) {
            const qty = Math.max(parseInt(row.querySelector('.qty-input').value) || 0, 0);
            const diskon = Math.max(parseInt(row.querySelector('.diskon-input').value) || 0, 0);

            let subtotal = (harga * qty) - diskon;
            if (subtotal < 0) subtotal = 0;

            row.querySelector('.subtotal').textContent = subtotal.toLocaleString('id-ID');
            calculateTotals();
        }

        function removeRow(rowId, id) {
            document.getElementById(rowId)?.remove();
            delete orderItems[id];
            calculateTotals();
        }

        function calculateTotals() {
            let totalItem = 0;
            let subTotal = 0;
            let totalDiskon = 0;

            for (let key in orderItems) {
                const row = document.getElementById(orderItems[key].rowId);
                if (!row) continue;

                const qty = Math.max(parseInt(row.querySelector('.qty-input').value) || 0, 0);
                const diskon = Math.max(parseInt(row.querySelector('.diskon-input').value) || 0, 0);
                const harga = orderItems[key].harga;

                totalItem++;
                subTotal += harga * qty;
                totalDiskon += diskon;
            }

            const pajakPersen = 0; // Ganti jika ingin pajak, misalnya 0.1 untuk 10%
            const pajak = (subTotal - totalDiskon) * pajakPersen;
            const grandTotal = subTotal - totalDiskon + pajak;

            document.getElementById('total-item').textContent = totalItem;
            document.getElementById('sub-total').textContent = subTotal.toLocaleString('id-ID');
            document.getElementById('diskon-total').textContent = totalDiskon.toLocaleString('id-ID');
            document.getElementById('tax-total').textContent = pajak.toLocaleString('id-ID');
            document.getElementById('grand-total').textContent = grandTotal.toLocaleString('id-ID');
        }
    </script>
    {{-- <script>
        function searchByBarcode(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                const barcode = event.target.value;

                // Make AJAX call to search product
                fetch(`/api/products/barcode/${barcode}`)
                    .then(response => response.json())
                    .then(product => {
                        if (product) {
                            // Add product to order using existing addToOrder function
                            addToOrder(product.product_name, product.selling_price, product.id);
                            // Clear barcode input
                            event.target.value = '';
                        } else {
                            alert('Product not found!');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error searching product');
                    });
            }
        }
    </script> --}}
@endsection
