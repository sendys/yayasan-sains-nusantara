@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Tables';
    $title = 'Produk';
    ?>

    @include('layouts.partials.page-title')
    @include('layouts.partials.preloader')

    <div class="row">
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">General</h5>

                            <div class="mb-3">
                                <label for="product-name" class="form-label">Nama Produk <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                                    id="product_name" name="product_name" value="{{ old('product_name') }}"
                                    placeholder="e.g : Apple iMac">
                                @error('product_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="product_code" class="form-label">SKU <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="product_code" name="product_code"
                                            value="{{ old('product_code') }}"
                                            class="form-control @error('product_code') is-invalid
                                                
                                            @enderror"
                                            placeholder="e.g : P001">
                                        @error('product_code')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="barcode" class="form-label">Barcode</label>
                                        <div class="input-group">
                                            <input type="text" id="barcode" name="barcode" value="{{ old('barcode') }}"
                                                class="form-control" placeholder="e.g : 1234567890123" maxlength="13">
                                            <button type="button" class="ladda-button  btn btn-info" dir="ltr"
                                                data-style="slide-left" id="generateBarcodeBtn" onclick="generateBarcode()"
                                                data-loading-text="Generating...">Generate</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="product-description" class="form-label">Deskripsi Produk <span
                                        class="text-danger">*</span></label>
                                <div id="snow-editor" style="height: 150px;"></div>
                            </div>

                            {{--   <div class="mb-3">
                                <label for="product-summary" class="form-label">Product Summary</label>
                                <textarea class="form-control" id="product-summary" rows="3" placeholder="Please enter summary"></textarea>
                            </div> --}}

                            <div class="mb-3">
                                <label for="product-category" class="form-label">Kategori <span
                                        class="text-danger">*</span></label>

                                <select
                                    class="form-control select2 @error('kategori_id') is-invalid @enderror"
                                    id="kategori_id" name="kategori_id">
                                    <option disabled selected>Select</option>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}"
                                            {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="satuan_id" class="form-label">Satuan <span class="text-danger">*</span></label>

                                <select
                                    class="form-control select2 @error('satuan_id') is-invalid

                                @enderror"
                                    id="satuan_id" name="satuan_id">
                                    <option disabled selected>Select</option>
                                    @foreach ($satuans as $satuan)
                                        <option value="{{ $satuan->id }}"
                                            {{ old('satuan_id') == $satuan->id ? 'selected' : '' }}>
                                            {{ $satuan->nama }}</option>
                                    @endforeach
                                </select>
                                @error('satuan_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="purchase_price">Harga Beli <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01"
                                            class="form-control @error('purchase_price') is-invalid 
                                            
                                        @enderror text-end"
                                            id="purchase_price" name="purchase_price" value="{{ old('purchase_price') }}"
                                            placeholder="0">
                                        @error('purchase_price')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="selling_price">Harga Jual <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01"
                                            class="form-control @error('selling_price') is-invalid 
                                            
                                        @enderror text-end"
                                            id="selling_price" name="selling_price" value="{{ old('selling_price') }}"
                                            placeholder="0">
                                        @error('selling_price')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="mb-3">
                                <label class="mb-2">Status <span class="text-danger">*</span></label>
                                <br />
                                <div class="d-flex flex-wrap">
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="radioInline"
                                            value="option1" id="inlineRadio1" checked>
                                        <label class="form-check-label" for="inlineRadio1">Aktif</label>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input" type="radio" name="radioInline"
                                            value="option2" id="inlineRadio2">
                                        <label class="form-check-label" for="inlineRadio2">Tidak Aktif</label>
                                    </div>

                                </div>
                            </div>

                            {{--  <div>
                                <label class="form-label">Comment</label>
                                <textarea class="form-control" rows="3" placeholder="Please enter comment"></textarea>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Gambar Produk</h5>
                            <div class="mb-3">
                                <label for="product-images" class="form-label">Pilih Gambar</label>
                                <input type="file" class="form-control" id="image" name="image"
                                    accept="image/*" onchange="previewImages(event)">
                                <small class="text-muted">You can select multiple images</small>
                                <div id="image-preview" class="mt-3 d-flex flex-wrap gap-2"></div>
                            </div>
                            {{-- <div class="dropzone-previews mt-3" id="file-previews"></div> --}}
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Stok</h5>

                            <div class="mb-3">
                                <label for="product-meta-title" class="form-label">Stok Tersedia</label>
                                <input type="number" class="form-control text-end" id="stock" name="stock"
                                    value="{{ old('stock', 0) }}" placeholder="Enter stok">
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="min_stock" class="form-label">Stok Minimum</label>
                                        <input type="number" class="form-control text-end" id="min_stock"
                                            name="min_stock" value="{{ old('min_stock', 0) }}"
                                            placeholder="Enter stok minimum">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="max_stock" class="form-label">Stok Maximum</label>
                                        <input type="number" class="form-control text-end" id="max_stock"
                                            name="max_stock" value="{{ old('max_stock', 0) }}"
                                            placeholder="Enter stok maximum">
                                    </div>
                                </div>
                            </div>

                            {{--   <div>
                                <label for="product-meta-description" class="form-label">Meta Description </label>
                                <textarea class="form-control" rows="5" id="product-meta-description" placeholder="Please enter description"></textarea>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="mb-3">
                        <button type="submit" class="btn w-sm btn-success waves-effect waves-light">Simpan</button>
                        <a href="{{ route('product.index') }}" class="btn btn-secondary waves-effect">Batal</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function previewImages(event) {
            const preview = document.getElementById('image-preview');
            preview.innerHTML = '';

            const files = event.target.files;

            for (const file of files) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '150px';
                    img.style.height = '150px';
                    img.style.objectFit = 'cover';
                    img.className = 'rounded border';
                    preview.appendChild(img);
                }

                reader.readAsDataURL(file);
            }
        }

        function generateBarcode() {
            const generateBtn = document.getElementById('generateBarcodeBtn');
            const barcodeInput = document.getElementById('barcode');

            // Disable button and show loading
            generateBtn.disabled = true;
            generateBtn.innerHTML = 'Generating...';

            fetch('{{ route('product.generate-barcode') }}')
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
