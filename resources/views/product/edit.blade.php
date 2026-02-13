@extends('layouts.app') {{-- Sesuaikan dengan layout Anda --}}

@section('content')
<div class="container">
    <h1>Edit Product: {{ $product->product_name }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('product.update', $product->uuid) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="product_name">Product Name</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" value="{{ old('product_name', $product->product_name) }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="product_code">Product Code</label>
                    <input type="text" class="form-control" id="product_code" name="product_code" value="{{ old('product_code', $product->product_code) }}" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="barcode">Barcode</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="barcode" name="barcode" value="{{ old('barcode', $product->barcode) }}" maxlength="13">
                        <button type="button" class="btn btn-outline-primary" id="generateBarcodeBtn" onclick="generateBarcode()">Generate</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="kategori_id">Kategori</label>
                    <select class="form-control" id="kategori_id" name="kategori_id" required>
                        <option value="">Select Kategori</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_id', $product->kategori_id) == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option> {{-- Asumsi nama field di Kategori adalah nama_kategori --}}
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="satuan_id">Satuan</label>
                    <select class="form-control" id="satuan_id" name="satuan_id" required>
                        <option value="">Select Satuan</option>
                        @foreach ($satuans as $satuan)
                            <option value="{{ $satuan->id }}" {{ old('satuan_id', $product->satuan_id) == $satuan->id ? 'selected' : '' }}>{{ $satuan->nama }}</option> {{-- Asumsi nama field di Satuan adalah nama_satuan --}}
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="purchase_price">Purchase Price</label>
                    <input type="number" step="0.01" class="form-control" id="purchase_price" name="purchase_price" value="{{ old('purchase_price', $product->purchase_price) }}" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="selling_price">Selling Price</label>
                    <input type="number" step="0.01" class="form-control" id="selling_price" name="selling_price" value="{{ old('selling_price', $product->selling_price) }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="stock">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="stock_min">Minimum Stock</label>
                    <input type="number" class="form-control" id="stock_min" name="stock_min" value="{{ old('stock_min', $product->stock_min) }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="stock_max">Maximum Stock</label>
                    <input type="number" class="form-control" id="stock_max" name="stock_max" value="{{ old('stock_max', $product->stock_max) }}" required>
                </div>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="image">Product Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
            @if ($product->image)
                <img src="{{ asset($product->image) }}" alt="{{ $product->product_name }}" width="100" class="mt-2">
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image" value="1">
                    <label class="form-check-label" for="remove_image">
                        Remove current image
                    </label>
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
        <a href="{{ route('product.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
    function generateBarcode() {
        const generateBtn = document.getElementById('generateBarcodeBtn');
        const barcodeInput = document.getElementById('barcode');
        
        // Disable button and show loading
        generateBtn.disabled = true;
        generateBtn.innerHTML = 'Generating...';
        
        fetch('{{ route("product.generate-barcode") }}')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    barcodeInput.value = data.barcode;
                } else {
                    alert('Gagal generate barcode. Silakan coba lagi.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            })
            .finally(() => {
                // Re-enable button
                generateBtn.disabled = false;
                generateBtn.innerHTML = 'Generate';
            });
    }
</script>
@endsection