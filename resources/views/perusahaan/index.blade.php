@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Tables';
    $title = 'Manage Data Perusahaan';
    ?>
    @include('layouts.partials.page-title')

    <style>
        .root-row {
            background-color: #e6f0ff;
            /* biru muda */
            font-weight: 600;
            font-weight: bold;
        }
        
        .table-danger {
            background-color: #f8d7da !important;
            animation: pulse-danger 2s infinite;
        }
        
        @keyframes pulse-danger {
            0% { background-color: #f8d7da; }
            50% { background-color: #f5c6cb; }
            100% { background-color: #f8d7da; }
        }
        
        .expired-badge {
            animation: blink 1.5s infinite;
        }
        
        @keyframes blink {
            0%, 50% { opacity: 1; }
            51%, 100% { opacity: 0.5; }
        }
        
        .modal-header.bg-danger {
            background: linear-gradient(45deg, #dc3545, #c82333) !important;
        }
        
        .alert-danger {
            border-left: 4px solid #dc3545;
        }
    </style>

    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title">Manage Data Perusahaan</h4>
                    <p class="sub-header">
                        Kelola data perusahaan dengan mudah. Tambah, edit, dan hapus data perusahaan sesuai kebutuhan.
                    </p>

                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <form method="GET" action="{{ route('perusahaan.index') }}"
                                class="d-flex flex-wrap align-items-center">
                                <label for="status-select" class="me-2">Show</label>
                                <div class="me-sm-2">
                                    <select class="form-select" name="per_page" onchange="this.form.submit()">
                                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100
                                        </option>
                                    </select>
                                </div>

                                <label for="inputPassword2" class="visually-hidden">Search</label>
                                <div class="me-1">
                                    <div class="position-relative">
                                        <i class="mdi mdi-magnify position-absolute ms-2"
                                            style="top: 50%; transform: translateY(-50%);"></i>
                                        <input type="search" id="search" name="search"
                                            class="form-control my-1 my-lg-0 ps-4" id="inputPassword2"
                                            placeholder="Search..." value="{{ request('search') }}"
                                            onkeyup="if(this.value.length === 0) this.form.submit()" autofocus>
                                    </div>

                                </div>

                            </form>
                        </div>
                        <div class="col-auto">
                            <div class="text-lg-end my-1 my-lg-0">
                                <button type="button" class="btn btn-success waves-effect waves-light mb-2 me-1"><i
                                        class="mdi mdi-cog"></i></button>
                                <a href="{{ route('perusahaan.create') }}"
                                    class="btn btn-primary waves-effect waves-light mb-2"><i
                                        class="mdi mdi-plus me-1"></i>Add Data Perusahaan</a>
                            </div>
                        </div><!-- end col-->
                    </div>
                    <br>

                    @if (isset($perusahaans) && $perusahaans->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover table-sm mb-0" id="perusahaanTable">
                                <thead>
                                    <tr>
                                        <th style="width: 200px;">Nama Perusahaan</th>
                                        <th>Email</th>
                                        <th>Telp</th>
                                        <th>Alamat</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Berakhir</th>
                                        <th>Status</th>
                                        <th>Premium</th>
                                        <th style="width: 100px;"></th>
                                    </tr>
                                </thead>

                                <!-- Satu tbody saja -->
                                <tbody id="data-tbody">
                                    <!-- Spinner loading -->
                                    <tr id="loading-row">
                                        <td colspan="9" class="text-center">
                                            <div class="spinner-border text-success m-2" role="status">
                                                {{-- <img src="{{ asset('assets/images/loading.gif') }}" alt="Loading..." style="width: 40px; height: 40px; margin: 20px auto; display: block;"> --}}
                                            </div>

                                            <br class="mt-2">Sedang memuat data...</br>
                                        </td>
                                    </tr>

                                    @foreach ($perusahaans as $perusahaan)
                                        <tr class="data-row d-none {{ $perusahaan->isExpired() ? 'table-danger' : '' }}">
                                            <td>{{ $perusahaan->name }}</td>
                                            <td>{{ $perusahaan->email }}</td>
                                            <td>{{ $perusahaan->phone }}</td>
                                            <td>{{ $perusahaan->address }}</td>
                                            <td>{{ $perusahaan->start_date ? $perusahaan->start_date->format('d/m/Y') : '-' }}</td>
                                            <td>
                                                @if($perusahaan->end_date)
                                                    @if($perusahaan->isExpired())
                                                        <span class="text-danger fw-bold">{{ $perusahaan->end_date->format('d/m/Y') }} <i class="mdi mdi-alert-circle expired-badge"></i></span>
                                                        <br><small class="text-danger">Terlambat {{ $perusahaan->getDaysOverdue() }} hari</small>
                                                    @else
                                                        {{ $perusahaan->end_date->format('d/m/Y') }}
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if($perusahaan->is_status == '1')
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-danger">Tidak Aktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($perusahaan->is_premium == '1')
                                                    <span class="badge bg-warning">Premium</span>
                                                @else
                                                    <span class="badge bg-secondary">Regular</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('perusahaan.show', $perusahaan->id) }}" class="action-icon" title="Lihat detail">
                                                    <i class="mdi mdi-eye"></i>
                                                </a>
                                                <a href="{{ route('perusahaan.edit', $perusahaan->id) }}" class="action-icon" title="Edit">
                                                    <i class="mdi mdi-square-edit-outline"></i>
                                                </a>
                                                <form action="{{ route('perusahaan.destroy', $perusahaan->id) }}"
                                                    method="POST" class="delete-perusahaan-form" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="action-icon btn-delete-perusahaan"
                                                        data-perusahaan-name="{{ $perusahaan->name }}" title="Hapus perusahaan"
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
                            {!! $perusahaans->appends(['search' => request('search'), 'per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover table-sm mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 200px;">Nama Perusahaan</th>
                                        <th>Email</th>
                                        <th>Telp</th>
                                        <th>Alamat</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Berakhir</th>
                                        <th>Status</th>
                                        <th>Premium</th>
                                        <th style="width: 100px;"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="text-center p-4">
                            <img src="{{ asset('assets/images/empty.png') }}" alt="No data">
                            <h4 class="text-muted mt-3">No Records Found</h4>
                            <p class="text-muted">We couldn't find any perusahaan records. Try adding some new perusahaan.</p>
                            <a href="{{ route('perusahaan.create') }}" class="btn btn-primary mt-2">
                                <i class="mdi mdi-plus me-1"></i> Add New Perusahaan
                            </a>
                        </div>
                    @endif


                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>

    <!-- Modal Notifikasi Lisensi Expired -->
    @if(isset($expiredCompanies) && $expiredCompanies->count() > 0)
    <div class="modal fade" id="expiredLicenseModal" tabindex="-1" aria-labelledby="expiredLicenseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="expiredLicenseModalLabel">
                        <i class="mdi mdi-alert-circle me-2"></i>Peringatan Lisensi Expired
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert">
                        <h6 class="alert-heading"><i class="mdi mdi-alert-circle"></i> Perhatian!</h6>
                        <p class="mb-0">Terdapat {{ $expiredCompanies->count() }} perusahaan dengan lisensi yang sudah expired. Silakan perpanjang lisensi untuk melanjutkan layanan.</p>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Tanggal Berakhir</th>
                                    <th>Hari Terlambat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($expiredCompanies as $index => $company)
                                 <tr>
                                     <td>{{ $index + 1 }}</td>
                                     <td>{{ $company->name }}</td>
                                     <td class="text-danger fw-bold">{{ $company->end_date->format('d/m/Y') }}</td>
                                     <td class="text-danger fw-bold">{{ $company->getDaysOverdue() }} hari</td>
                                     <td>
                                         <a href="{{ route('perusahaan.edit', $company->id) }}" class="btn btn-sm btn-warning">
                                             <i class="mdi mdi-pencil"></i> Perpanjang
                                         </a>
                                     </td>
                                 </tr>
                                 @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <a href="{{ route('perusahaan.index') }}" class="btn btn-primary">Kelola Perusahaan</a>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Script: Hide spinner, show data rows -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const loadingRow = document.getElementById('loading-row');
            const dataRows = document.querySelectorAll('.data-row');

            setTimeout(() => {
                if (loadingRow) loadingRow.remove(); // Remove spinner row
                dataRows.forEach(row => row.classList.remove('d-none')); // Show data
                
                // Show expired license modal if exists
                @if(isset($expiredCompanies) && $expiredCompanies->count() > 0)
                setTimeout(() => {
                    const expiredModal = new bootstrap.Modal(document.getElementById('expiredLicenseModal'));
                    expiredModal.show();
                    
                    // Play notification sound (optional)
                    try {
                        const audio = new Audio('data:audio/wav;base64,UklGRnoGAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQoGAACBhYqFbF1fdJivrJBhNjVgodDbq2EcBj+a2/LDciUFLIHO8tiJNwgZaLvt559NEAxQp+PwtmMcBjiR1/LMeSwFJHfH8N2QQAoUXrTp66hVFApGn+DyvmwhBSuBzvLZiTYIG2m98OScTgwOUarm7blmGgU7k9n1unEiBC13yO/eizEIHWq+8+OWT');
                        audio.volume = 0.3;
                        audio.play().catch(() => {});
                    } catch (e) {}
                }, 500);
                @endif
            }, 1000);
        });
    </script>

    {{-- Fungsi Delete --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-delete-perusahaan');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('form');
                    const perusahaanName = this.getAttribute('data-perusahaan-name');
                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        html: `Nama Perusahaan "${perusahaanName}"<br>will be permanently deleted.`,
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