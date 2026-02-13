@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Tables';
    $title = 'User';
                    ?>
    @include('layouts.partials.page-title')

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">User Baru</h4>
                    <p class="text-muted font-14">
                        Form ini untuk menambah user baru.
                    </p>

                    <form action="{{ route('user.store') }}" method="POST" class="parsley-examples">
                        @csrf

                        {{-- <div class="mb-3">
                            <label for="name" class="form-label">Nama Perusahaan/Usaha<span
                                    class="text-danger">*</span></label>
                            <input type="text" id="perusahaan_id" name="perusahaan_id" value="{{ old('perusahaan_id') }}"
                                parsley-trigger="change" required placeholder="Nama Perusahaan / Usaha" class="form-control"
                                readonly />
                        </div> --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap<span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" parsley-trigger="change"
                                required placeholder="Nama pengguna" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" parsley-trigger="change"
                                required placeholder="Email" class="form-control" />
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor WhatsApp</label>
                            <div class="input-group">
                                <span class="input-group-text">+62</span>
                                <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                    id="phone" min="0" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    value="{{ old('phone') }}" placeholder="Enter your phone number" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                            <input type="password" id="password" name="password" parsley-trigger="change" required
                                placeholder="Password" class="form-control" />
                            <small class="form-text text-muted">
                                Kata sandi harus mengandung setidaknya satu huruf kecil, satu huruf besar,
                                satu angka dan satu karakter khusus (@$!%*?&)
                            </small>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role<span class="text-danger">*</span></label>

                            <select class="form-select my-1 my-lg-0" name="roles">
                                @foreach ($roles as $role)
                                    @if (Auth::user()->hasRole('super_admin') || $role->name !== 'super_admin')
                                        <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                                    @endif
                                @endforeach

                            </select>

                        </div>

                        <div class="text-end">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">Simpan</button>
                            <a href="{{ route('user.index') }}" class="btn btn-secondary waves-effect">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function () {
            $('#select-roles').select2({
                placeholder: "Choose ...",
                width: '100%'
            });
        });
    </script>
@endsection