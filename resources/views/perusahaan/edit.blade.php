@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Tables';
    $title = 'Edit Perusahaan';
    ?>

    @include('layouts.partials.page-title')
    @include('layouts.partials.preloader')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted font-14">
                        Silakan edit data perusahaan pada form di bawah ini. Pastikan mengisi data dengan benar, <br>
                        terutama untuk field yang wajib diisi seperti Nama Perusahaan.
                    </p>
                    <hr class="my-1">
                    <br>

                    <form action="{{ route('perusahaan.update', $perusahaan->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                        value="{{ old('name', $perusahaan->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="mb-2">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                        value="{{ old('email', $perusahaan->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="mb-2">
                                    <label for="phone" class="form-label">Telp/WA</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                                        value="{{ old('phone', $perusahaan->phone) }}">
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="address" class="form-label">Alamat</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3">{{ old('address', $perusahaan->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Tanggal Mulai</label>
                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date"
                                        value="{{ old('start_date', $perusahaan->start_date ? $perusahaan->start_date->format('Y-m-d') : '') }}">
                                    @error('start_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">Tanggal Berakhir</label>
                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date"
                                        value="{{ old('end_date', $perusahaan->end_date ? $perusahaan->end_date->format('Y-m-d') : '') }}">
                                    @error('end_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="is_status" class="form-label">Status</label>
                                    <select class="form-select @error('is_status') is-invalid @enderror" id="is_status" name="is_status">
                                        <option value="1" {{ old('is_status', $perusahaan->is_status) == '1' ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ old('is_status', $perusahaan->is_status) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                    @error('is_status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="is_premium" class="form-label">Tipe</label>
                                    <select class="form-select @error('is_premium') is-invalid @enderror" id="is_premium" name="is_premium">
                                        <option value="0" {{ old('is_premium', $perusahaan->is_premium) == '0' ? 'selected' : '' }}>Regular</option>
                                        <option value="1" {{ old('is_premium', $perusahaan->is_premium) == '1' ? 'selected' : '' }}>Premium</option>
                                    </select>
                                    @error('is_premium')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Informasi Tambahan</label>
                                    <div class="card border-light">
                                        <div class="card-body p-3">
                                            <small class="text-muted">
                                                <strong>Dibuat:</strong> {{ $perusahaan->created_at->format('d/m/Y H:i') }}<br>
                                                <strong>Diperbarui:</strong> {{ $perusahaan->updated_at->format('d/m/Y H:i') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('perusahaan.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script>
        // Validasi tanggal berakhir tidak boleh lebih kecil dari tanggal mulai
        document.getElementById('end_date').addEventListener('change', function() {
            const startDate = document.getElementById('start_date').value;
            const endDate = this.value;
            
            if (startDate && endDate && endDate < startDate) {
                alert('Tanggal berakhir tidak boleh lebih kecil dari tanggal mulai');
                this.value = '';
            }
        });
        
        document.getElementById('start_date').addEventListener('change', function() {
            const startDate = this.value;
            const endDate = document.getElementById('end_date').value;
            
            if (startDate && endDate && endDate < startDate) {
                alert('Tanggal berakhir tidak boleh lebih kecil dari tanggal mulai');
                document.getElementById('end_date').value = '';
            }
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