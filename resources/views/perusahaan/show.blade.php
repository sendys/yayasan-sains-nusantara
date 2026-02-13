@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Detail';
    $title = 'Detail Perusahaan';
    ?>

    @include('layouts.partials.page-title')
    @include('layouts.partials.preloader')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="header-title">Detail Perusahaan</h4>
                        <div>
                            <a href="{{ route('perusahaan.edit', $perusahaan->id) }}" class="btn btn-warning btn-sm">
                                <i class="mdi mdi-pencil me-1"></i>Edit
                            </a>
                            <a href="{{ route('perusahaan.index') }}" class="btn btn-secondary btn-sm">
                                <i class="mdi mdi-arrow-left me-1"></i>Kembali
                            </a>
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-light">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">Informasi Dasar</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless mb-0">
                                        <tr>
                                            <td class="fw-bold" style="width: 40%;">Nama Perusahaan:</td>
                                            <td>{{ $perusahaan->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Email:</td>
                                            <td>{{ $perusahaan->email ?: '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Telepon:</td>
                                            <td>{{ $perusahaan->phone ?: '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Alamat:</td>
                                            <td>{{ $perusahaan->address ?: '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card border-light">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">Status & Periode</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless mb-0">
                                        <tr>
                                            <td class="fw-bold" style="width: 40%;">Status:</td>
                                            <td>
                                                @if ($perusahaan->is_status == '1')
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-danger">Tidak Aktif</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Tipe:</td>
                                            <td>
                                                @if ($perusahaan->is_premium == '1')
                                                    <span class="badge bg-warning">Premium</span>
                                                @else
                                                    <span class="badge bg-secondary">Regular</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Tanggal Mulai:</td>
                                            <td>{{ $perusahaan->start_date ? $perusahaan->start_date->format('d/m/Y') : '-' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Tanggal Berakhir:</td>
                                            <td>{{ $perusahaan->end_date ? $perusahaan->end_date->format('d/m/Y') : '-' }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card border-light">
                                <div class="card-header bg-light">
                                    <h5 class="card-title mb-0">Informasi Sistem</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-borderless mb-0">
                                                <tr>
                                                    <td class="fw-bold" style="width: 40%;">Dibuat pada:</td>
                                                    <td>{{ $perusahaan->created_at->format('d/m/Y H:i:s') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold">Diperbarui pada:</td>
                                                    <td>{{ $perusahaan->updated_at->format('d/m/Y H:i:s') }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            @if ($perusahaan->deleted_at)
                                                <div class="alert alert-warning">
                                                    <strong>Peringatan:</strong> Data ini telah dihapus pada
                                                    {{ $perusahaan->deleted_at->format('d/m/Y H:i:s') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($perusahaan->start_date && $perusahaan->end_date)
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="card border-light">
                                    <div class="card-header bg-light">
                                        <h5 class="card-title mb-0">Durasi Operasional</h5>
                                    </div>
                                    <div class="card-body">
                                        @php
                                            $startDate = $perusahaan->start_date;
                                            $endDate = $perusahaan->end_date;
                                            $today = now();

                                            $totalDays = $startDate->diffInDays($endDate);
                                            $remainingDays = floor($today->floatDiffInDays($endDate, false));
                                            $isExpired = $today->gt($endDate);
                                            $progressPercentage =
                                                $totalDays > 0
                                                    ? (($totalDays - max(0, $remainingDays)) / $totalDays) * 100
                                                    : 0;
                                        @endphp

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="text-center">
                                                    <h3 class="text-primary">{{ $totalDays }}</h3>
                                                    <p class="text-muted mb-0">Total Hari</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-center">
                                                    @if ($isExpired)
                                                        <h3 class="text-danger">Expired</h3>
                                                        <p class="text-muted mb-0">{{ abs(floor($remainingDays)) }} hari
                                                            yang lalu</p>
                                                    @else
                                                        <h3 class="text-success">{{ $remainingDays }}</h3>
                                                        <p class="text-muted mb-0">Hari Tersisa</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-center">
                                                    <h3
                                                        class="{{ $progressPercentage >= 80 ? 'text-warning' : 'text-info' }}">
                                                        {{ number_format($progressPercentage, 1) }}%</h3>
                                                    <p class="text-muted mb-0">Progress</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-3">
                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar {{ $isExpired ? 'bg-danger' : ($progressPercentage >= 80 ? 'bg-warning' : 'bg-success') }}"
                                                    role="progressbar" style="width: {{ min(100, $progressPercentage) }}%"
                                                    aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    {{-- Success/Error Messages --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                showConfirmButton: true
            });
        </script>
    @endif
@endsection
