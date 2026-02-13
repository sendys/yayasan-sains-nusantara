@extends('layouts.app')
@section('content')
    <?php
    $sub_title = 'Tables';
    $title = 'Data Kas/Bank';
    ?>

    @include('layouts.partials.page-title')
    @include('layouts.partials.preloader')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Data Transaksi Kas/Bank</h4>
                    <p class="text-muted font-14">
                        Form ini untuk menambah Transaksi Kas/Bank.
                    </p>

                    <form action="{{ route('akun.store') }}" method="POST" class="parsley-examples">
                        @csrf
                        <!-- Bayar Dari -->
                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <label for="bayar_dari" class="form-label fw-bold">Bayar Dari</label>
                                        <select class="form-select" id="bayar_dari">
                                            <option selected>(1-10001) - Kas (Cash & Bank)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 d-flex align-items-end">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="bayar_nanti">
                                            <label class="form-check-label fw-bold" for="bayar_nanti">Bayar Nanti</label>
                                        </div>
                                        <div class="ms-auto">
                                            <h4 class="text-end text-primary fw-bold">Total <span>Rp. 0,00</span></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        <!-- Info Transaksi -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="penerima" class="form-label fw-bold">Penerima</label>
                                <select class="form-select" id="penerima">
                                    <option selected>Pilih kontak</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="tgl_transaksi" class="form-label fw-bold">Tgl Transaksi</label>
                                <input type="date" class="form-control" id="tgl_transaksi" value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="cara_pembayaran" class="form-label fw-bold">Cara Pembayaran</label>
                                <select class="form-select" id="cara_pembayaran">
                                    <option selected>Cek & Giro</option>
                                </select>
                            </div>
                        </div>
                
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="no_biaya" class="form-label fw-bold">No Biaya</label>
                                <input type="text" class="form-control" id="no_biaya" placeholder="[Auto]">
                            </div>
                            <div class="col-md-6">
                                <label for="tag" class="form-label fw-bold">Tag</label>
                                <input type="text" class="form-control" id="tag">
                            </div>
                        </div>
                
                        <div class="mb-3">
                            <label for="alamat_penagihan" class="form-label fw-bold">Alamat Penagihan</label>
                            <textarea class="form-control" id="alamat_penagihan" rows="2"></textarea>
                        </div>
                
                        <!-- Detail Biaya -->
                        <div class="table-responsive mb-3">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Akun Biaya</th>
                                        <th>Deskripsi</th>
                                        <th>Pajak</th>
                                        <th>Jumlah</th>
                                        <th><input type="checkbox" disabled></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><select class="form-select"><option selected>Pilih akun biaya</option></select></td>
                                        <td><input type="text" class="form-control"></td>
                                        <td><select class="form-select"><option selected>Pilih pajak</option></select></td>
                                        <td><input type="text" class="form-control text-end" value="Rp. 0,00"></td>
                                        <td class="text-center"><button class="btn btn-sm btn-danger">-</button></td>
                                    </tr>
                                    <tr>
                                        <td><select class="form-select"><option selected>Pilih akun biaya</option></select></td>
                                        <td><input type="text" class="form-control"></td>
                                        <td><select class="form-select"><option selected>Pilih pajak</option></select></td>
                                        <td><input type="text" class="form-control text-end" value="Rp. 0,00"></td>
                                        <td class="text-center"><button class="btn btn-sm btn-danger">-</button></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="btn btn-primary btn-sm">+ Tambah Data</button>
                        </div>
                
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="hargaTermasukPajak">
                            <label class="form-check-label fw-bold" for="hargaTermasukPajak">Harga termasuk pajak</label>
                        </div>
                
                        <div class="mb-3">
                            <label for="memo" class="form-label fw-bold">Memo</label>
                            <textarea class="form-control" id="memo" rows="3"></textarea>
                        </div>
                
                        <div class="mb-3">
                            <label class="form-label fw-bold">Lampiran</label>
                            <div class="form-control text-muted" style="height: 70px;">
                                📎 Tarik file ke sini, atau <a href="#">pilih file</a>
                            </div>
                        </div>
                
                        <!-- Total -->
                        <div class="text-end">
                            <p>SubTotal: Rp. 0,00</p>
                            <p>Total: <strong>Rp. 0,00</strong></p>
                            <p class="text-primary"><i class="bi bi-info-circle"></i> Masukan Jumlah Pemotongan</p>
                            <h5 class="fw-bold">Total <span class="text-primary">Rp. 0,00</span></h5>
                        </div>
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