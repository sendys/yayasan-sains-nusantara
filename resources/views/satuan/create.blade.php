@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Tables';
    $title = 'Satuan';
    ?>
    @include('layouts.partials.page-title')
    @include('layouts.partials.preloader')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Satuan Baru</h4>
                    <p class="text-muted font-14">Form ini untuk Satuan baru.</p>
                    <form action="{{ route('satuan.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="mb-3">
                                    <label for="kode" class="form-label">Kode</label>
                                    <input type="text" class="form-control @error('kode') is-invalid @enderror" id="kode" name="kode" value="{{ old('kode') }}" required>
                                    @error('kode')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('satuan.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
    
@endsection