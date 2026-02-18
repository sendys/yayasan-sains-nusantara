<!DOCTYPE html>
<html lang="id">

<head>

    @include('layouts.frontend.head-css')

</head>

<body>

    <!-- header -->
    <header class="fixed-top header">
        <!-- top header -->
        @include('layouts.frontend.top-header')
        <!-- navbar -->
        <div class="navigation w-100">
            <div class="container">
                @include('layouts.frontend.navbar')
            </div>
        </div>
    </header>
    <!-- /header -->

    {{-- Untuk Blade biasa --}}
    @yield('content')

    <!-- footer -->
    @include('layouts.frontend.footer')
    <!-- /footer -->

    <!-- jQuery -->
    <script src="{{ asset('assets/fe/plugins/jQuery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/fe/plugins/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/fe/plugins/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets/fe/plugins/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/fe/plugins/venobox/venobox.min.js') }}"></script>
    <script src="{{ asset('assets/fe/plugins/mixitup/mixitup.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places">
    </script>
    <script src="{{ asset('assets/fe/plugins/google-map/gmap.js') }}"></script>
    <script src="{{ asset('assets/fe/js/script.js') }}"></script>

</body>

</html>
