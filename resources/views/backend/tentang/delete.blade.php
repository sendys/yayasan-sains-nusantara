@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Tentang Kami';
    $title = 'Hapus Data Tentang Kami';
    ?>

    @include('layouts.partials.page-title')
    @include('layouts.partials.preloader')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card border-danger">
                                <div class="card-header bg-danger text-white">
                                    <h5 class="mb-0"><i class="mdi mdi-delete me-2"></i>Konfirmasi Hapus Data</h5>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-4">
                                        <i class="mdi mdi-alert-circle-outline text-danger" style="font-size: 64px;"></i>
                                        <h4 class="mt-3">Apakah Anda yakin ingin menghapus data ini?</h4>
                                        <p class="text-muted">Data akan dihapus secara soft delete dan dapat dipulihkan
                                            nanti.</p>
                                    </div>

                                    <hr>

                                    <!-- Data Preview -->
                                    <div class="mb-4">
                                        <h6 class="fw-semibold mb-3"><i class="mdi mdi-information me-1"></i>Data yang akan
                                            dihapus:</h6>

                                        @if ($tentang->logo)
                                            <div class="mb-3 text-center">
                                                <img src="{{ asset('storage/' . $tentang->logo) }}" alt="Logo"
                                                    class="img-fluid rounded" style="max-height: 150px;">
                                            </div>
                                        @endif

                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="30%">Deskripsi</th>
                                                <td>{{ Str::limit(strip_tags($tentang->deskripsi ?? '-'), 100) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Visi</th>
                                                <td>{{ Str::limit(strip_tags($tentang->visi ?? '-'), 100) }}</td>
                                            </tr>
                                            @if ($tentang->misi && count($tentang->misi) > 0)
                                                <tr>
                                                    <th>Misi</th>
                                                    <td>
                                                        <ul class="mb-0 ps-3">
                                                            @foreach ($tentang->misi as $misi)
                                                                @if (!empty($misi))
                                                                    <li>{{ $misi }}</li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <th>Dibuat</th>
                                                <td>{{ $tentang->created_at->format('d M Y H:i') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Diperbarui</th>
                                                <td>{{ $tentang->updated_at->format('d M Y H:i') }}</td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="alert alert-warning">
                                        <i class="mdi mdi-alert me-2"></i>
                                        <strong>Perhatian:</strong> Tindakan ini tidak dapat dibatalkan. Data yang dihapus
                                        dapat dipulihkan dari database.
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('admin.tentang.index') }}" class="btn btn-secondary">
                                            <i class="mdi mdi-arrow-left me-1"></i>Kembali
                                        </a>
                                        <form id="deleteForm" action="{{ route('admin.tentang.destroy', $tentang->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" id="confirmDelete">
                                                <i class="mdi mdi-delete me-1"></i>Ya, Hapus Data
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Delete Form Submit with AJAX
            $('#deleteForm').on('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Konfirmasi Terakhir',
                    text: 'Apakah Anda benar-benar ingin menghapus data ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: $('#deleteForm').attr('action'),
                            type: 'POST',
                            data: $('#deleteForm').serialize(),
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: response.message,
                                        showConfirmButton: false,
                                        timer: 2000
                                    }).then(() => {
                                        window.location.href =
                                            '{{ route('admin.tentang.index') }}';
                                    });
                                }
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: xhr.responseJSON?.message ||
                                        'Terjadi kesalahan saat menghapus data.'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
