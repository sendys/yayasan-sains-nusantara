@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Tables';
    $title = 'Manage Data Produk';
    ?>
    @include('layouts.partials.page-title')

    <style>
        .root-row {
            background-color: #e6f0ff;
            /* biru muda */
            font-weight: 600;
            font-weight: bold;
        }
    </style>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <form method="GET" action="{{ route('product.index') }}"
                                class="d-flex flex-wrap align-items-center">
                                <label for="status-select" class="me-1">Showing</label>
                                <div class="me-1">
                                    <select class="form-select my-1 my-lg-0" name="per_page" onchange="this.form.submit()">
                                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100
                                        </option>
                                    </select>
                                </div>
                                
                                <label for="status-select"></label>
                                <div class="me-1">
                                    <div class="position-relative">
                                        <i class="mdi mdi-filter position-absolute ms-2" style="top: 50%; transform: translateY(-50%);"></i>
                                        <select class="form-select my-1 my-lg-0 ps-4" id="status-select" name="status" onchange="this.form.submit()">
                                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                                            <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Deactive</option>
                                        </select>
                                    </div>
                                </div>
                                <label for="inputPassword2" class="visually-hidden">Search</label>
                                <div class="me-1">
                                    <div class="position-relative">
                                        <i class="mdi mdi-magnify position-absolute ms-2" style="top: 50%; transform: translateY(-50%);"></i>
                                        <input type="search" id="search" name="search" class="form-control my-1 my-lg-0 ps-4"
                                            id="inputPassword2" placeholder="Search..." value="{{ request('search') }}"
                                            onkeyup="if(this.value.length === 0) this.form.submit()" autofocus>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="col-auto">
                            <div class="text-lg-end my-1 my-lg-0">
                                <a href="#" class="btn btn-info waves-effect waves-light"><i
                                        class="mdi mdi-file-import me-1"></i></a>

                                <a href="{{ route('product.create') }}" class="btn btn-primary waves-effect waves-light"><i
                                        class="mdi mdi-plus-circle me-1"></i> Add New Produk</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    @if (isset($products) && $products->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover table-sm mb-0 overflow-auto"
                                id="rolesTable" style="max-height: 500px;">
                                <thead class="bg-light" style="height: 50px;">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th style="width: 150px;">SKU</th>
                                        <th style="width: 150px;">Barcode</th>
                                        <th style="width: 500px;">Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Satuan</th>
                                        <th style="width: 100px;">Harga Beli</th>
                                        <th style="width: 100px;">Harga Jual</th>
                                        <th class="text-center">Stok</th>
                                        <th class="text-center">Stok Min</th>
                                        <th class="text-center">Stok Mak</th>
                                        <th style="width: 100px;"></th>
                                    </tr>
                                </thead>

                                <!-- Satu tbody saja -->
                                <tbody id="data-tbody">
                                    <!-- Spinner loading -->
                                    <tr id="loading-row">
                                        <td colspan="12" class="text-center">
                                            <div class="spinner-border text-success m-2" role="status">
                                                {{-- <img src="{{ asset('assets/images/loading.gif') }}" alt="Loading..." style="width: 40px; height: 40px; margin: 20px auto; display: block;"> --}}
                                            </div>

                                            <br class="mt-2">Sedang memuat data...</br>
                                        </td>
                                    </tr>

                                    @foreach ($products as $product)
                                        <tr class="data-row d-none">
                                            <td class="text-center" style="width: 100px">
                                                {{ $products->firstItem() + $loop->index }}</td>
                                            <td>{{ $product->product_code }}</td>
                                            <td>{{ $product->barcode }}</td>
                                            <td>
                                                @php
                                                    $searchTerm = request('search', '');
                                                    $productName = $product->product_name;
                                                    if ($searchTerm && stripos($productName, $searchTerm) !== false) {
                                                        $highlightedName = preg_replace('/(' . preg_quote($searchTerm, '/') . ')/i', '<span class="bg-warning">$1</span>', $productName);
                                                        echo html_entity_decode($highlightedName);
                                                    } else {
                                                        echo e($productName);
                                                    }
                                                @endphp
                                            </td>
                                            <td>{{ $product->kategori->nama ?? 'N/A' }}</td> {{-- Asumsi nama field di Kategori adalah nama_kategori --}}
                                            <td>{{ $product->satuan->nama ?? 'N/A' }}</td> {{-- Asumsi nama field di Satuan adalah nama_satuan --}}
                                            <td class="text-end">{{ number_format($product->purchase_price, 0, ',', '.') }}</td>
                                            <td class="text-end">{{ number_format($product->selling_price, 0, ',', '.') }}</td>
                                            <td style="width: 100px;" class="text-center">{{ $product->stock }}</td>
                                            <td style="width: 100px;" class="text-center">{{ $product->stock_min }}</td>
                                            <td style="width: 100px;" class="text-center">{{ $product->stock_max }}</td>
                                            <td>
                                                <a href="{{ route('product.edit', $product->uuid) }}" class="action-icon">
                                                    <i class="mdi mdi-square-edit-outline"></i>
                                                </a>
                                                <form action="{{ route('product.destroy', $product->uuid) }}"
                                                    method="POST" class="delete-role-form" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="action-icon btn-delete-role"
                                                        data-role-name="{{ $product->product_name }}"
                                                        title="Hapus supplier"
                                                        style="background: none; border: none; padding: 0; cursor: pointer; color: inherit;">

                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {!! $products->appends(['search' => request('search'), 'per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover table-sm">
                                <thead class="bg-light" style="height: 50px;">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th style="width: 300px;">Kode Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Satuan</th>
                                        <th>Harga Jual</th>
                                        <th>Stok</th>
                                        <th style="width: 100px;"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="text-center p-4">
                            <img src="{{ asset('assets/images/product_empty.png') }}" alt="No data">
                            <h4 class="text-muted mt-3">No Records Found</h4>
                            <p class="text-muted">We couldn't find any produk records. Try adding some new produk.</p>
                            <a href="{{ route('product.create') }}" class="btn btn-primary mt-2">
                                <i class="mdi mdi-plus me-1"></i> Add New Produk
                            </a>
                        </div>
                    @endif


                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div>

    </div>

    <!-- Script: Hide spinner, show data rows -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const loadingRow = document.getElementById('loading-row');
            const dataRows = document.querySelectorAll('.data-row');

            setTimeout(() => {
                if (loadingRow) loadingRow.remove(); // Remove spinner row
                dataRows.forEach(row => row.classList.remove('d-none')); // Show data
            }, 500);
        });
    </script>

    {{-- Fungsi Delete --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-delete-role');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('form');
                    const roleName = this.getAttribute('data-role-name');
                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        html: `Nama Produk "${roleName}"<br>will be permanently deleted.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $.toast({
                    heading: 'Success',
                    text: `{!! session('success') !!}`,
                    showHideTransition: 'slide up',
                    icon: 'success',
                    loader: true,
                    loaderBg: '#2ecc71',
                    position: 'top-right',
                    hideAfter: 3000
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $.toast({
                    heading: 'Gagal',
                    text: `{!! session('error') !!}`,
                    showHideTransition: 'slide up',
                    icon: 'danger',
                    loader: true,
                    loaderBg: '#e74c3c',
                    position: 'top-right',
                    hideAfter: 3000
                });
            });
        </script>
    @endif
@endsection
