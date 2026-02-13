@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Satuan yang Dihapus (Trash)</h3>
                    <div class="card-tools">
                        <a href="{{ route('satuan.index') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Satuan
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Tanggal Dihapus</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($trashedSatuans as $index => $satuan)
                                    <tr>
                                        <td>{{ $trashedSatuans->firstItem() + $index }}</td>
                                        <td>{{ $satuan->kode }}</td>
                                        <td>{{ $satuan->nama }}</td>
                                        <td>{{ $satuan->deleted_at->format('d/m/Y H:i:s') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <form action="{{ route('satuan.restore', $satuan->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-success btn-sm" 
                                                            onclick="return confirm('Apakah Anda yakin ingin memulihkan data ini?')">
                                                        <i class="fas fa-undo"></i> Pulihkan
                                                    </button>
                                                </form>
                                                
                                                <form action="{{ route('satuan.force-delete', $satuan->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" 
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini secara permanen? Data yang dihapus tidak dapat dikembalikan!')">
                                                        <i class="fas fa-trash"></i> Hapus Permanen
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data satuan yang dihapus</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $trashedSatuans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection