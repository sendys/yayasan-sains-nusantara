@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-md-8">
                <h1>Kelola Banner</h1>
            </div>
            <div class="col-md-4 text-right">
                <a href="{{ route('admin.banner.create') }}" class="btn btn-primary">Tambah Banner</a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            @forelse ($banners as $banner)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ $banner->image_url }}" class="card-img-top" alt="Banner"
                            style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <p class="card-text">
                                <strong>Status:</strong>
                                <span class="badge {{ $banner->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $banner->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </p>
                            <p class="card-text text-muted">
                                <small>Dibuat: {{ $banner->created_at->format('d M Y H:i') }}</small>
                            </p>
                        </div>
                        <div class="card-footer">
                            <form action="{{ route('admin.banner.toggle', $banner) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                <button type="submit"
                                    class="btn btn-sm {{ $banner->is_active ? 'btn-warning' : 'btn-success' }}">
                                    {{ $banner->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                            </form>
                            <form action="{{ route('admin.banner.destroy', $banner) }}" method="POST"
                                style="display: inline;" onsubmit="return confirm('Hapus banner ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">Belum ada banner. <a href="{{ route('admin.banner.create') }}">Tambah
                            banner</a></div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
