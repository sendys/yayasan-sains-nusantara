@extends('layouts.app')
@section('content')
    <?php
    $sub_title = 'Tables';
    $title = 'Permissions';
    ?>
    @include('layouts.partials.page-title')
    @include('layouts.partials.preloader')

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Permission Baru</h4>
                    <p class="text-muted font-14">
                        Form ini untuk menambah beberapa Permission.
                    </p>

                    <form action="{{ route('permission.store') }}" method="POST" class="parsley-examples">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Permission<span
                                    class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                parsley-trigger="change" required placeholder="Nama Permission" class="form-control" />
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Group Permission<span
                                    class="text-danger">*</span></label>
                            <input type="text" id="group" name="group" value="{{ old('group') }}"
                                parsley-trigger="change" required placeholder="Group Permission" class="form-control" />
                        </div>

                        <div class="text-end">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">Simpan</button>
                            <a href="{{ route('permission.index') }}" class="btn btn-secondary waves-effect">Kembali</a>

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
