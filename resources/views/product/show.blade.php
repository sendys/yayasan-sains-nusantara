@extends('layouts.app') {{-- Sesuaikan dengan layout Anda --}}

@section('content')
<div class="container">
    <h1>{{ $product->product_name }}</h1>

    <div class="row">
        <div class="col-md-8">
            <table class="table table-bordered">
                <tr>
                    <th>Product Code</th>
                    <td>{{ $product->product_code }}</td>
                </tr>
                <tr>
                    <th>Barcode</th>
                    <td>{{ $product->barcode ?: 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <td>{{ $product->kategori->nama_kategori ?? 'N/A' }}</td> {{-- Asumsi nama field di Kategori adalah nama_kategori --}}
                </tr>
                <tr>
                    <th>Satuan</th>
                    <td>{{ $product->satuan->nama_satuan ?? 'N/A' }}</td> {{-- Asumsi nama field di Satuan adalah nama_satuan --}}
                </tr>
                <tr>
                    <th>Purchase Price</th>
                    <td>{{ number_format($product->purchase_price, 2) }}</td>
                </tr>
                <tr>
                    <th>Selling Price</th>
                    <td>{{ number_format($product->selling_price, 2) }}</td>
                </tr>
                <tr>
                    <th>Stock</th>
                    <td>{{ $product->stock }}</td>
                </tr>
                <tr>
                    <th>Minimum Stock</th>
                    <td>{{ $product->stock_min }}</td>
                </tr>
                <tr>
                    <th>Maximum Stock</th>
                    <td>{{ $product->stock_max }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $product->created_at->format('d M Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $product->updated_at->format('d M Y H:i') }}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-4">
            @if ($product->image)
                <img src="{{ asset($product->image) }}" alt="{{ $product->product_name }}" class="img-fluid">
            @else
                <p>No image available.</p>
            @endif
        </div>
    </div>

    <a href="{{ route('product.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    <a href="{{ route('product.edit', $product->uuid) }}" class="btn btn-warning mt-3">Edit</a>
</div>
@endsection