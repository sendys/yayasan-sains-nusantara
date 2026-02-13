@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Tables';
    $title = 'Supplier';
    ?>

    @include('layouts.partials.page-title')
    @include('layouts.partials.preloader')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted font-14">
                        Silakan lengkapi data supplier baru pada form di bawah ini. Pastikan mengisi data dengan benar, <br>
                        terutama untuk field yang wajib diisi seperti Nama dan Email.
                    </p>
                    <hr class="my-1">
                    <br>
                    <form action="{{ route('supplier.update', $supplier->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', $supplier->name) }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="company_name" class="form-label">Nama Perusahaan</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name"
                                        value="{{ old('company_name', $supplier->company_name) }}">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Telp/WA</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="{{ old('address', $supplier->phone) }}">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('address', $supplier->email) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="address" name="address">{{ old('address', $supplier->address) }}</textarea>
                                </div>

                            </div>
                            <div class="col-md-6 mb-3">
                                <!-- Upload Foto -->
                                <div class="mb-3">
                                    <label class="form-label">Logo</label>

                                    @php
                                        $photoUrl = $supplier->photo
                                            ? Storage::url($supplier->photo)
                                            : asset('assets/images/empty1.png');
                                    @endphp

                                    <div class="position-relative rounded border overflow-hidden"
                                        style="width: 120px; height: 120px; cursor: pointer;"
                                        onmouseover="showOverlay(true)" onmouseout="showOverlay(false)"
                                        onclick="document.getElementById('photo').click()">

                                        <!-- Gambar Preview -->
                                        <img id="preview-image" src="{{ $photoUrl }}" class="w-100 h-100"
                                            style="object-fit: cover;">

                                        <!-- Overlay -->
                                        <div id="overlay"
                                            class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center gap-2"
                                            display: none;">
                                            <i class="fa fa-trash" onclick="hapusFoto(event)"></i>
                                        </div>

                                        <!-- Input File -->
                                        <input type="file" name="photo" id="photo" class="d-none" accept="image/*"
                                            onchange="previewFoto(event)">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('supplier.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showOverlay(show) {
            const overlay = document.getElementById('overlay');
            overlay.style.display = show ? 'flex' : 'none';
        }

        function previewFoto(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('preview-image').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function hapusFoto(event) {
            event.stopPropagation();
            document.getElementById('photo').value = '';
            document.getElementById('preview-image').src = "{{ asset('assets/images/empty1.png') }}";
            showOverlay(false);
        }
    </script>
@endsection
