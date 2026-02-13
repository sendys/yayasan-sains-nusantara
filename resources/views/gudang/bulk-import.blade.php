@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Import';
    $title = 'Bulk Import Data Gudang';
    ?>
    @include('layouts.partials.page-title')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Bulk Import Data Gudang</h4>
                    <p class="sub-header">
                        <code style="font-weight: bold; font-size: 15px;">Import Data Gudang</code> 
                        <span style="font-weight: bold; font-size: 12px;">dari file CSV untuk menambahkan multiple data sekaligus.</span>
                    </p>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card border border-primary">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0"><i class="mdi mdi-upload me-2"></i>Upload File CSV</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('gudang.process-bulk-import') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="csv_file" class="form-label">Pilih File CSV</label>
                                            <input type="file" class="form-control @error('csv_file') is-invalid @enderror" 
                                                   id="csv_file" name="csv_file" accept=".csv,.txt" required>
                                            @error('csv_file')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">
                                                <i class="mdi mdi-information-outline"></i>
                                                File harus berformat CSV dengan maksimal ukuran 2MB
                                            </div>
                                        </div>

                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="mdi mdi-upload me-1"></i>Import Data
                                            </button>
                                            <a href="{{ route('gudang.index') }}" class="btn btn-secondary">
                                                <i class="mdi mdi-arrow-left me-1"></i>Kembali
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border border-info">
                                <div class="card-header bg-info text-white">
                                    <h5 class="mb-0"><i class="mdi mdi-download me-2"></i>Template CSV</h5>
                                </div>
                                <div class="card-body">
                                    <p class="mb-3">Download template CSV untuk format yang benar:</p>
                                    <a href="{{ route('gudang.download-template') }}" class="btn btn-info btn-block w-100">
                                        <i class="mdi mdi-download me-1"></i>Download Template
                                    </a>
                                </div>
                            </div>

                            <div class="card border border-warning mt-3">
                                <div class="card-header bg-warning text-dark">
                                    <h5 class="mb-0"><i class="mdi mdi-alert me-2"></i>Petunjuk</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="mb-0 ps-3">
                                        <li>File harus berformat CSV</li>
                                        <li>Kolom yang diperlukan: <strong>kode</strong>, <strong>nama</strong></li>
                                        <li>Kode gudang harus unik</li>
                                        <li>Maksimal 255 karakter untuk nama</li>
                                        <li>Maksimal 50 karakter untuk kode</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(session('errors'))
                        <div class="alert alert-danger mt-4">
                            <h6><i class="mdi mdi-alert-circle me-2"></i>Error Details:</h6>
                            <ul class="mb-0">
                                @foreach(session('errors') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
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

    @if (session('warning'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $.toast({
                    heading: 'Warning',
                    text: `{!! session('warning') !!}`,
                    showHideTransition: 'slide up',
                    icon: 'warning',
                    loader: true,
                    loaderBg: '#f39c12',
                    position: 'top-right',
                    hideAfter: 5000
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $.toast({
                    heading: 'Error',
                    text: `{!! session('error') !!}`,
                    showHideTransition: 'slide up',
                    icon: 'error',
                    loader: true,
                    loaderBg: '#e74c3c',
                    position: 'top-right',
                    hideAfter: 5000
                });
            });
        </script>
    @endif
@endsection