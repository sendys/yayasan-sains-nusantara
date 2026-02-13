@extends('layouts.app')
@section('content')
    <?php
    $sub_title = 'Tables';
    $title = 'Data Pembelian';
    ?>

    @include('layouts.partials.page-title')
    @include('layouts.partials.preloader')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Data Transaksi Pembelian</h4>
                    <p class="text-muted font-14">
                        Form ini untuk menambah Transaksi Pembelian.
                    </p>

                    <form>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>Supplier *</label>
                                <select class="form-control">
                                    <option value="">Pilih supplier</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="e.g. john@example.com">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>Alamat penagihan</label>
                                <textarea class="form-control" rows="2" placeholder="e.g. Jalan Indonesia Blok C No. 22"></textarea>
                            </div>
                            <div class="col-md-2">
                                <label>Tgl. transaksi</label>
                                <input type="date" class="form-control">
                                <label class="mt-2">Tgl. jatuh tempo</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label>No Transaksi</label>
                                <input type="text" class="form-control" placeholder="[Auto]">
                                <label class="mt-2">Nomor referensi supplier</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label>Syarat pembayaran</label>
                                <select class="form-control">
                                    <option>Net 30</option>
                                </select>
                                <label class="mt-2">Gudang</label>
                                <select class="form-control">
                                    <option value="">Pilih gudang</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            {{-- <div class="col-md-3">
                                <label>Syarat pembayaran</label>
                                <select class="form-control">
                                    <option>Net 30</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Gudang</label>
                                <select class="form-control">
                                    <option value="">Pilih gudang</option>
                                </select>
                            </div> --}}
                            <div class="col-md-12 d-flex align-items-end justify-content-end">
                                <h4 class="text-end">Total <strong>Rp0,00</strong></h4>
                            </div>
                        </div>

                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th style="width: 500px;">Produk</th>
                                    <th>Deskripsi</th>
                                    <th>Kuantitas</th>
                                    <th>Unit</th>
                                    <th>Harga satuan</th>
                                    <th>Pajak</th>
                                    <th style="width: 150px;">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="form-control select2-products" name="product_id">
                                            <option value="">Pilih produk</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" placeholder="Deskripsi produk"></td>
                                    <td><input type="number" class="form-control" placeholder="0"></td>
                                    <td><input type="text" class="form-control" placeholder="Unit"></td>
                                    <td><input type="text" class="form-control" placeholder="Rp0"></td>
                                    <td><input type="text" class="form-control" placeholder="PPN"></td>
                                    <td class="text-end">Rp0,00</td>
                                </tr>
                            </tbody>
                        </table>

                        {{-- <button class="btn btn-primary btn-sm">+ Tambah Data</button> --}}

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="includeTax">
                            <label class="form-check-label" for="includeTax">Harga termasuk pajak</label>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label>Pesan</label>
                                <textarea class="form-control mb-3" rows="2"></textarea>
                                <label>Memo</label>
                                <textarea class="form-control mb-3" rows="2"></textarea>
                                <label>Lampiran</label>
                                <input type="file" class="form-control">
                                <small class="text-muted">File berupa Excel, Word, PDF, JPG, PNG, atau ZIP (maks. 5 file &
                                    10MB/file)</small>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless text-end">
                                    <tr>
                                        <td>Subtotal</td>
                                        <td>Rp0,00</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td>Rp0,00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="form-check float-start">
                                                <input class="form-check-input" type="checkbox" id="potongan">
                                                <label class="form-check-label" for="potongan">Pemotongan</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Sisa tagihan</th>
                                        <th>Rp0,00</th>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-between">
                            <button class="btn btn-secondary">Batalkan</button>
                            <div>
                                <button class="btn btn-outline-primary dropdown-toggle me-2">Buat</button>
                                <button class="btn btn-primary">Simpan & Bayar</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript --}}
    <script>
        $(document).ready(function() {
            $('.select2-products').select2({
                placeholder: 'Pilih produk',
                allowClear: true,
                ajax: {
                    url: '/products/search', // Create this route
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page || 1
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.items,
                            pagination: {
                                more: data.pagination.more
                            }
                        };
                    },
                    cache: true
                },
                minimumInputLength: 2
            });
        });
    </script>

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
